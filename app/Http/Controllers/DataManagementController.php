<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Store;
use App\Models\SubCategory;
use App\Traits\ApiDataGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DataManagementController extends Controller
{
    use ApiDataGenerate;

    public function productsList()
    {

        $products = Product::with('variants', 'brand', 'childcategory', 'subcategory', 'category', 'store')->get();
        $productsDeleted = Product::onlyTrashed()->get()->pluck('id');
        return response()->json([
            'status' => 200,
            'products' => $products,
            'productsDeleted' => $productsDeleted
        ]);

    }

    public function updateProductRecords()
    {
        try {

            ini_set('max_execution_time', '600'); //300 seconds = 5 minutes

            $response = file_get_contents('https://fc98-139-135-34-85.ap.ngrok.io/api/product-lists');
            $newsData = json_decode($response);
//            dd($newsData);

            $products = $newsData->products;
            $productsDeleted = $newsData->productsDeleted;
            Product::whereIn('id', $productsDeleted)->delete();
            // UPLOAD BULK-PRODUCTS FROM EXCEL SHEET

            foreach ($products as $key => $product) {


                // FIND CATEGORY-ID
                $category = Category::where('title', $product->category->title)->first();
                if ($category) {
                    $category_id = $category->id;
                } else {
                    return response()->json([
                        "status" => 100,
                        "message" => "Category Not Found",
                        "category" => $product->category->title
                    ]);
                }

                // FIND SUBCATEGORY-ID
                $subcategory = SubCategory::where([
                    'category_id' => $category_id,
                    'title' => $product->subcategory->title
                ])
                    ->first();

                if ($subcategory) {
                    $subcategory_id = $subcategory->id;
                } else {
                    return response()->json([
                        "status" => 100,
                        "message" => 'Sub Category Not Found',
                        "subcategory" => $product->subcategory->title
                    ]);
                }

                // FIND CHILD-CATEGORY-ID
                $child_category = ChildCategory::where([
                    'subcategory_id' => $subcategory_id,
                    'title' => $product->childcategory->title
                ])
                    ->first();
                if ($child_category) {
                    $child_category_id = $child_category->id;
                } else {
                    return response()->json([
                        "status" => 100,
                        "message" => 'Child Category Not Found',
                        "child_category" => $product->childcategory->title
                    ]);
                }


                // FIND BRAND-ID OR CREATE NEW BRAND
                $brand = Brand::where('name', $product->brand->name)
                    ->first();


                if ($brand) {
                    $brand_id = $brand->id;
                } else {
                    $brand_id = Brand::insertGetId([
                        'name' => $product->brand->name,
                        'slug' => $this->createSlug('brands', $product->brand->name),
                        'featured' => 0,
                        'status' => 1
                    ]);
                }

                // FIND STORE-ID
                $store = Store::where('store_name', $product->store->store_name)->first();
                if ($store) {
                    $store_id = $store->id;
                } else {
                    return response()->json([
                        "status" => 100,
                        "message" => 'Store Not Found',
                        "store_name" => $product->store->store_name
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
                        'name' => $product->name,
                        'category_id' => $category_id,
                        'subcategory_id' => $subcategory_id,
                        'childcategory_id' => $child_category_id,
                        'brand_id' => $brand_id,
                        'store_id' => $store_id,
                    ],
                    [

                        'name' => $product->name,
                        'slug' => $product->slug,
//                        'slug' => $this->createSlug('products', $product['name']),
                        'category_id' => $category_id,
                        'subcategory_id' => $subcategory_id,
                        'childcategory_id' => $child_category_id,
                        'brand_id' => $brand_id,
                        'store_id' => $store_id,
                        'video_url' => $product->video_url ?? null,
                        'short_description' => $product->short_description,
                        'detailed_description' => $product->detailed_description,
                        'package_contents' => $product->package_contents,
                        'primary_image' => $product->primary_image ?? "default.jpg",
                        'warranty_type' => 1,
                        'warranty_period_id' => 1,
                        'warranty_policy' => $product->warranty_policy,
                        'package_weight' => 0,
                        'package_length' => 0,
                        'package_width' => 0,
                        'package_height' => 0,
                        'good_type' => 0,
                        'status' => 1,
                    ]);
                // dd($product_id);
                foreach ($product->variants as $variant) {
                    ProductVariant::updateOrcreate(
                        [
                            'product_id' => $product_id->id,
                            'seller_sku' => $variant->seller_sku,
                        ],
                        [
                            'product_id' => $product_id->id,
                            'price' => $variant->price,
                            'special_price' => $variant->special_price,
                            'quantity' => $variant->quantity,
                            'seller_sku' => $variant->seller_sku,
                            'availability' => $variant->availability,
                            'image' => $variant->image ?? null,
                        ]);
                }

            }

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => "Congratulations, Products are uploaded successfully",
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                "status" => 100,
                "message" => 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }

    }

    public function productsDetailImages()
    {

        $products = Product::with('images', 'store')->get();
        return response()->json([
            'status' => 200,
            'products' => $products,
        ]);

    }

    public function updateProductsDetailImages()
    {
        try {

            ini_set('max_execution_time', '600'); //300 seconds = 5 minutes

            $response = file_get_contents('https://a27b-2400-adc5-42d-5100-71a9-d5ac-9f1b-a519.ap.ngrok.io/api/product-detail-images');
            $newsData = json_decode($response);
//            dd($newsData);

            $products = $newsData->products;

            // UPLOAD BULK-PRODUCTS FROM EXCEL SHEET

            foreach ($products as $key => $product) {
                // FIND CATEGORY-ID
                $store = Store::where('store_name', $product->store->store_name)->first();
                if (!$store) {
                    return response()->json([
                        "status" => 100,
                        "message" => "Store Not Found",
                        "product_id" => $product->name,
                    ]);
                }
                $product_exist = Product::where('name', 'like', '%' . $product->name . '%')->where('store_id', $store->id)->first();
                if (!$product_exist) {
                    return response()->json([
                        "status" => 100,
                        "message" => "Product Not Found",
                        "product_id" => $product->name,
                    ]);
                }
                ProductImage::where('product_id', $product_exist->id)->delete();
                foreach ($product->images as $image) {
                    ProductImage::updateOrcreate(['product_id' => $product_exist->id, 'image' => $image->image],
                        ['product_id' => $product_exist->id, 'image' => $image->image]
                    );
                }
            }

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => "Congratulations, Products are uploaded successfully",
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                "status" => 100,
                "message" => 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }

    }

}
