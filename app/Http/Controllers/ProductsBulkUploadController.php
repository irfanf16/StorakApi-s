<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\Product;

use App\Models\Category;
use App\Models\SubCategory;

use App\Traits\ApiDataGenerate;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\ProductVariant;
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class ProductsBulkUploadController extends Controller
{
    use ApiDataGenerate;
    /*
    |==============================================================
    | Upload Products In Bulk -- With Default Variant
    |==============================================================
    */
    public function defaultVariantForm()
    {
        try {
            return view('admin.products.default_variant');

        }
        catch (\Exception $e) {

            return response()->json([
                "status" => 100,
                "message"=> 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }

    }
    public function detailedProductsForm()
    {
        try {
            return view('admin.products.detailed_products');

        }
        catch (\Exception $e) {

            return response()->json([
                "status" => 100,
                "message"=> 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }

    }



    /*
    |==============================================================
    | Upload Products In Bulk -- With Default Variant
    |==============================================================
    */
    public function bulkUploadWithDefaultVariant(Request $request)
    {
        try {

            // START PRODUCT BULK-UPLOAD OPERATION
            DB::beginTransaction();

            $this->validate($request, [
                'uploaded_file' => 'required|mimes:xls,xlsx,csv'
            ]);

            $path = $request->file('uploaded_file')->getRealPath();
//        $path1 = $request->file('uploaded_file')->store('temp');
//        $path = storage_path('app').'/'.$path1;
            // GET PRODUCTS LISTING IN AN-ARRAY
            $products = Excel::toArray(new ProductsImport, $path);
            // dd($products);

                                    //=== OR ===//
            // ========= GET PRODUCTS LISTING IN A COLLECTION ==========
            // $collection = Excel::toCollection(new ProductsImport, $path);


            // UPLOAD BULK-PRODUCTS FROM EXCEL SHEET
            foreach ($products[0] as $key => $product) {

                // FIND CATEGORY-ID
                $category = Category::where('title', $product['category_id'])->first();
                if ($category) {
                    $category_id = $category->id;
                }
                else{
                    return response()->json([
                        "status"   => 100,
                        "message"  => "Category Not Found",
                        "category" => $product['category_id'],
                    ]);
                }

                // FIND SUBCATEGORY-ID
                $subcategory = SubCategory::where([
                                                'category_id' => $category_id,
                                                'title'=> $product['subcategory_id'],
                                            ])
                                            ->first();

                if ($subcategory) {
                    $subcategory_id = $subcategory->id;
                }
                else{
                    return response()->json([
                        "status"      => 100,
                        "message"     => 'Sub Category Not Found',
                        "subcategory" => $product['subcategory_id'],
                    ]);
                }

                // FIND CHILD-CATEGORY-ID
                $child_category = ChildCategory::where([
                                                    'subcategory_id' => $subcategory_id,
                                                    'title' => $product['childcategory_id']
                                                ])
                                                ->first();
                if ($child_category) {
                    $child_category_id = $child_category->id;
                }
                else{
                    return response()->json([
                        "status"         => 100,
                        "message"        => 'Child Category Not Found',
                        "child_category" => $product['childcategory_id'],
                    ]);
                }


                // FIND BRAND-ID OR CREATE NEW BRAND
                $brand = Brand::where('name', $product['brand_id'])
                                ->first();


                if($brand){
                   $brand_id = $brand->id;
                }
                else{
                    $brand_id = Brand::insertGetId([
                        'name'    => $product['brand_id'],
                        'slug'    =>$this->createSlug('brands',$product['brand_id']),
                        'featured' => 0,
                        'status'  => 1
                    ]);
                }

                // FIND STORE-ID
                $store = Store::where('store_name', $product['store_id'])->first();
                if($store){
                    $store_id = $store->id;
                }
                else{
                    return response()->json([
                        "status"         => 100,
                        "message"        => 'Store Not Found',
                        "child_category" => $product['store_id'],
                    ]);
                }


                // FIND DUPLICATE PRODUCT
                // $is_duplicate = Product::where([
                //                             'store_id' => $store_id,
                //                             'name'     => $product['name']
                //                         ])
                //                         ->first();
                // if ($is_duplicate) {
                //     return response()->json([
                //         "status"  => 100,
                //         "message" => 'Duplicate Product',
                //         "Product" => $product['name'],
                //     ]);
                // }
                $product_id = Product::UpdateOrCreate(
                    [
                        'name'                => $product['name'],
                        'category_id'         => $category_id,
                        'subcategory_id'      => $subcategory_id,
                        'childcategory_id'    => $child_category_id,
                        'brand_id'            => $brand_id,
                        'store_id'            => $store_id,
                    ],
                    [

                    'name'                => $product['name'],
                    'slug'                =>$this->createSlug('products',$product['name']),
                    'category_id'         => $category_id,
                    'subcategory_id'      => $subcategory_id,
                    'childcategory_id'    => $child_category_id,
                    'brand_id'            => $brand_id,
                    'store_id'            => $store_id,
                    'video_url'           => $product['video_url'] ?? null,
                    'short_description'   => $product['short_description'],
                    'detailed_description'=> $product['detailed_description'],
                    'package_contents'    => $product['package_contents'],
                    'primary_image'       => $product['primary_image'] ?? "default.jpg",
                    'warranty_type'       => 1,
                    'warranty_period_id'  => 1,
                    'warranty_policy'     => $product['warranty_policy'],
                    'package_weight'      => 0,
                    'package_length'      => 0,
                    'package_width'       => 0,
                    'package_height'      => 0,
                    'good_type'           => 0,
                    'status'              => 1,
                ]);
                // dd($product_id);

                ProductVariant::updateOrcreate(
                    [
                        'product_id'   => $product_id->id,
                    ],
                    [
                    'product_id'   => $product_id->id,
                    'price'        => $product['price'],
                    'special_price'=> $product['special_price'],
                    'quantity'     => $product['quantity'],
                    'seller_sku'   => $product['seller_sku'],
                    'availability' => $product['availability'],
                    'image'        => $product['image'] ?? null,
                ]);
            }

            DB::commit();

            return response()->json([
                'status'  => 200,
                'message' => "Congratulations, Products are uploaded successfully",
            ]);

            return back()->with('success', 'Excel Data Imported successfully.');

        }
        catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                "status" => 100,
                "message"=> 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }

    }



    /*
    |==============================================================
    | Upload Products In Bulk -- With Default Variant
    |==============================================================
    */
    public function productDetailImages(Request $request)
    {
//        try {

            // START PRODUCT BULK-UPLOAD OPERATION
            DB::beginTransaction();

            $this->validate($request, [
                'uploaded_file' => 'required|mimes:xls,xlsx,csv'
            ]);

            $path = $request->file('uploaded_file')->getRealPath();

            // GET PRODUCTS LISTING IN AN-ARRAY
            $products = Excel::toArray(new ProductsImport, $path);
            // dd($products);

            //=== OR ===//
            // ========= GET PRODUCTS LISTING IN A COLLECTION ==========
            // $collection = Excel::toCollection(new ProductsImport, $path);


            // UPLOAD BULK-PRODUCTS FROM EXCEL SHEET
            foreach ($products[0] as $key => $product) {

                if (!$product['product_id'] || !$product['vendor'] || !$product['image']) {
                    return response()->json([
                        "status"   => 100,
                        "message"  => "Data missing please check",
                        "product_id" => $product['product_id'],
                        "image" => $product['image'],
                        "vendor" => $product['vendor'],
                    ]);
                }

                // FIND CATEGORY-ID
                $store=Store::where('store_name',$product['vendor'])->first();
                if (!$store) {
                    return response()->json([
                        "status"   => 100,
                        "message"  => "Store Not Found",
                        "product_id" => $product['product_id'],
                        "image" => $product['image'],
                        "vendor" => $product['vendor'],
                    ]);
                }
                $product_exist = Product::where(['name'=> $product['product_id'],'store_id'=>$store->id])->first();
                if (!$product_exist) {
                    return response()->json([
                        "status"   => 100,
                        "message"  => "Product Not Found",
                        "product_id" => $product['product_id'],
                        "image" => $product['image'],
                        "vendor" => $product['vendor'],
                    ]);
                }
              ProductImage::updateOrcreate(['product_id'=>$product_exist->id,'image'=>$product['image']],
                  ['product_id'=>$product_exist->id,'image'=>$product['image']]
              );
            }

            DB::commit();

            return response()->json([
                'status'  => 200,
                'message' => "Congratulations,Detailed Products are uploaded successfully",
            ]);


//        }
//        catch (\Exception $e) {
//
//            DB::rollback();
//
//            return response()->json([
//                "status" => 100,
//                "message"=> 'sorry, something went wrong',
//                "errors" => $e->getMessage()
//            ]);
//        }

    }





    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb

        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            }
            else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        }
        else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }





    public function sendEmail($email, $name)
    {
        $data = array(
            'email' => $email,
            'name' => $name,
            'subject' => 'Welcome Message',
        );

        Mail::send('welcomeEmail', $data, function ($message) use ($data) {
            $message->from('welcome@myapp.com');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
    }




    /*
    |==============================================================
    | Upload Products In Bulk -- With Color And Size Variant
    |==============================================================
    */
    public function bulkUploadDefault(Request $request)
    {
        try {
            return view('admin.products.default_variant');
        }
        catch (\Throwable $th) {
            //throw $th;
        }
    }

}
