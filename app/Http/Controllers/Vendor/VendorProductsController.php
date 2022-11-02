<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Traits\ApiDataGenerate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

use App\Traits\ApiHelper;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\SubCategory;
use App\Models\VariantAttribute;
use App\Models\WarrantyPeriod;


class VendorProductsController extends Controller
{
    use ApiHelper;
    use ApiDataGenerate;

    /*
    |=============================================================
    | Get Listing of All Products
    |=============================================================
    */
    public function index()
    {
        try {
            $has_store = Auth::user()->store ?? null;
            $products = Product::with('category:id,title')
                ->with('subcategory:id,title')
                ->with('childcategory:id,title')
                ->with('brand:id,name')
                ->with('variants.variantAttributes', function ($query) {
                    $query->with('attributeDetail:id,title');
                    $query->with('keyDetail:id,name');
                })
                ->where('store_id', Auth::user()->store->id ?? null)
                ->orderBy('id', 'desc')
                ->get();


            $products_count = count($products);
            $active_products = $products->where('status', 1)->count();
            $inactive_products = $products->where('status', 0)->count();
            $featured_products = $products->where('featured', 1)->count();

            return response()->json([
                'status' => 200,
                'products' => $products,
                'products_count' => $products_count,
                'active_products' => $active_products,
                'inactive_products' => $inactive_products,
                'featured_products' => $featured_products,
                'store_info' => $has_store
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    public function productList(Request $request)
    {
        try {
            $has_store = Auth::user()->store ?? null;
            if ($request->ajaxRequest == 1) {
                $products = Product::query()
                    ->with('category:id,title')
                    ->with('subcategory:id,title')
                    ->with('childcategory:id,title')
                    ->with('brand:id,name')
                    ->with('variants.variantAttributes', function ($query) {
                        $query->with('attributeDetail:id,title');
                        $query->with('keyDetail:id,name');
                    })
                    ->where('store_id', Auth::user()->store->id ?? null)
                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->search . "%");
                    })
                    ->when($request->has('category_id') && $request->filled('category_id'), function ($query) use ($request) {
                        $query->where('category_id',$request->category_id);
                    })
                    ->when($request->has('subcategory_id') && $request->filled('subcategory_id'), function ($query) use ($request) {
                        $query->where('subcategory_id',$request->subcategory_id);
                    })
                    ->when($request->has('childcategory_id') && $request->filled('childcategory_id'), function ($query) use ($request) {
                        $query->where('childcategory_id',$request->childcategory_id);
                    })
                    ->when($request->has('brand_id') && $request->filled('brand_id'), function ($query) use ($request) {
                        $query->where('brand_id',$request->brand_id);
                    })
                    ->when($request->has('status') && $request->filled('status'), function ($query) use ($request) {
                        $query->where('status',$request->status);
                    })
                    ->when($request->has('featured') && $request->filled('featured'), function ($query) use ($request) {
                        $query->where('featured',$request->featured);
                    })
                    ->when($request->has('from_date') && $request->filled('from_date'), function ($query) use ($request) {
                        $query->where('created_at','>',$request->from_date);
                    })
                    ->when($request->has('from_to') && $request->filled('from_to'), function ($query) use ($request) {
                        $query->where('created_at','<',$request->from_to);
                    })
                    ->when($request->has('translation') && $request->filled('translation'), function ($query) use ($request) {
                        $query->where('translation_verified', $request->translation);
                    })
                    ->latest()
                    ->paginate($request->datatable_length);


                return response()->json([
                    'status' => 200,
                    'products' => $products,
                    'imagesUrl' => storage_path('product/images/sm'),

                ]);

            }
            $products = Product::where('store_id', Auth::user()->store->id ?? null)->get();
            $products_count = count($products);
            $active_products = $products->where('status', 1)->count();
            $inactive_products = $products->where('status', 0)->count();
            $featured_products = $products->where('featured', 1)->count();
            $categories=Category::whereHas('products')->where('status',1)->select('id','title')->get();
            $sub_categories=SubCategory::whereHas('products')->where('status',1)->select('id','title')->get();
            $child_categories=SubCategory::whereHas('products')->where('status',1)->select('id','title')->get();
            $brands=Brand::whereHas('products')->where('status',1)->select('id','name')->get();

            return response()->json([
                'status' => 200,
                'products_count' => $products_count,
                'active_products' => $active_products,
                'inactive_products' => $inactive_products,
                'featured_products' => $featured_products,
                'store_info' => $has_store,
                 'categories' => $categories,
                'sub_categories' => $sub_categories,
                'child_categories' => $child_categories,
                'brands' => $brands,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==============================================================
    | Get Categories Listings For Create New Product Page
    |==============================================================
    */
    public function create()
    {
        try {
            $categories = Category::where('status', 1)
                ->select('id', 'title')
                ->orderBy('title', 'asc')
                ->get();

            $warranty_periods = WarrantyPeriod::where('status', 1)->get();

            $has_store = Auth::user()->store ?? null;

            return response()->json([
                'status' => 200,
                'categories' => $categories,
                'warranty' => $warranty_periods,
                'store_info' => $has_store
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==============================================================================================
    |  Get Subcategories And Brands Listing Based on Category_id For Create New Product Page
    |==============================================================================================
    */
    public function subcategoriesAndBrands(Request $request)
    {
        try {
            $data = Category::select('id', 'title')
                ->where('id', $request->id)
                ->with('subcategories')
                ->with('brands')
                ->first();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==================================================================================================
    |  Get Childcategories And Attributes Listing Based on Subcategory_id For Create New Product Page
    |==================================================================================================
    */
    public function childcategoriesAndAttributes(Request $request)
    {
        try {
            $results = SubCategory::select('id', 'title')
                ->where('id', $request->id)
                ->with('childcategories')
                ->with('attributes.keys')
                ->with('brands')
                ->first();


            return response()->json([
                'status' => 200,
                'results' => $results,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }

    public function childcategory_brands(Request $request)
    {
        // return $request->all();
        try {
            $results = ChildCategory::select('id', 'title')
                ->where('id', $request->id)
                ->with('brands', 'attributes', 'attributes.keys', 'sku_attributes', 'sku_attributes.keys')
                ->first();

            return response()->json([
                'status' => 200,
                'results' => $results,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }


    /*
    |===========================================================
    | Generate Random String
    |===========================================================
    */
    public function randomStr($strength)
    {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }


    /*
    |===========================================================
    | Store a Newly Created Product In the Database
    |===========================================================
    */
    public function store(Request $request)
    {
        // return ($request->input('primary_image'));
        // return $request->get('sku_images_data');
        if (!(Auth::user()->store)) {
            return response()->json([
                "status" => 403,
                "message" => "Please create your store first.",
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'short_description' => 'required',
            'warranty_type' => 'required',
            'package_weight' => 'required',
            'package_length' => 'required',
            'package_width' => 'required',
            'package_height' => 'required',
            'good_type' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        // STORE PRODUCT DETAIL DESCRIPTION
        $file_code = $this->randomStr(12);
        Storage::disk('product')->put("detail/$file_code.json", json_encode([
            'content' => $request->detailed_description,
        ]));
        // STORE PRODUCT DETAIL DESCRIPTION in arbic
        $file_code_ar = $this->randomStr(12);
        Storage::disk('product')->put("detail/$file_code_ar.json", json_encode([
            'content' =>$this->translate( $request->detailed_description ?? 'Not Provided','ar'),
        ]));

        // STORE PRODUCT PRIMARY-IMAGE
        $primary_image = $request->input('primary_image'); //your base64 encoded data
        $primary_image = ApiHelper::uploadFile($primary_image, 'product', 'images', true);

        // STORE PRODUCT DETAIL-IMAGES
        $i = 1;
        $detailimages = [];
        if ($request->input('files')) {

            foreach ($request->input('files') as $image) {
                $image_name = ApiHelper::uploadFile($image, 'product', 'images', true);
                array_push($detailimages, $image_name);
            }
        }

        $formData = [
            'name' => $request->name,
            'slug' =>$this->createSlug('products',$request->name),
            'name_ar' =>$this->translate( $request->name,'ar'),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'brand_id' => $request->brand_id,
            'store_id' => Auth::user()->store->id,
            'short_description' => $request->short_description,
            'short_description_ar' =>$this->translate($request->short_description,'ar'),
            'detailed_description' => "storage/product/detail/$file_code.json",
            'detailed_description_ar' => "storage/product/detail/$file_code_ar.json",
            'package_contents' => $request->package_contents,
            'warranty_type' => $request->warranty_type,
            'warranty_period_id' => $request->warranty_period_id,
            'warranty_policy' => $request->warranty_policy,
            'package_weight' => $request->package_weight,
            'package_length' => $request->package_length,
            'package_width' => $request->package_width,
            'package_height' => $request->package_height,
            'good_type' => $request->good_type,
            'primary_image' => $primary_image
        ];
        if ($request->warranty_type == 1) {
            $formData['warranty_period_id'] = NULL;
        }

        DB::beginTransaction();
        try {
            // STORE PRODUCT
            $newProduct = new Product();
            $saveProduct = $newProduct->create($formData);

            // STORE PRODUCT-DETAIL IMAGES
            // $images = $request->get('images');

            if ($detailimages) {
                foreach ($detailimages as $image) {
                    ProductImage::Create([
                        'product_id' => $saveProduct->id,
                        'image' => $image,
                    ]);
                }
            }

            // STORE PRODUCT-ATTRIBUTES
            $attributes = $request->get('attributes');
            if ($attributes) {
                foreach ($attributes as $attribute => $keys) {
                    if ($keys) {
                        foreach ($keys as $key) {
                            ProductAttribute::Create([
                                'product_id' => $saveProduct->id,
                                'attribute_id' => $attribute,
                                'key_id' => $key,
                            ]);
                        }
                    }

                }
            }

            // STORE PRODUCT-VARIANTS
            $prices = $request->get('price');
            $special_prices = $request->get('special_price');
            $quantities = $request->get('quantity');
            $seller_skus = $request->get('seller_sku');
            $availabilities = $request->get('availability');
            $sku_attributes = $request->get('sku_attributes'); //ARRAY OF DYNAMIC-ATTRIBUTES
            $sku_images_data = $request->get('sku_images_data');


            for ($i = 0; $i < count($prices); $i++) {
                // STORE PRODUCT VARIANT

                if ($sku_images_data[$i]) {
                    $image_name = self::uploadFile($sku_images_data[$i], 'public', 'product/variant/image');
                } else {
                    $image_name = null;
                }

                $saveVariant = ProductVariant::Create([
                    'product_id' => $saveProduct->id,
                    'price' => $prices[$i],
                    'special_price' => $special_prices[$i],
                    'quantity' => $quantities[$i],
                    'seller_sku' => $seller_skus[$i],
                    'availability' => $availabilities[$i],
                    'image' => $image_name
                ]);

                if ($sku_attributes) {
                    // STORE VARIANT-ATTIRUBUTE
                    foreach ($sku_attributes as $sku_attr) {
                        VariantAttribute::Create([
                            'product_variant_id' => $saveVariant->id,
                            'attribute_id' => $sku_attr,
                            'key_id' => $request->input("$sku_attr")[$i],
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                "status" => 200,
                "message" => "Product is Uploaded Successfully",
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }


    }


    /*
    |==========================================================
    | Get specified Vendor from storage for Read only
    |==========================================================
    */
    public function show($id)
    {
        //
    }


    /*
    |==========================================================
    | Get Specified Product from storage For Edit
    |==========================================================
    */
    public function edit($id)
    {
        try {
            $variant = ProductVariant::with('product.category.subcategories.childcategories')
                                    ->with('product.subcategory:id,title')
                                    ->with('product.childcategory:id,title')
                                    ->with('product.category.brands')
                                    ->with('product.brand:id,name')
                                    ->with('product.images')
                                    ->with('product.productAttributes', function($query){
                                        $query->with('attributeDetail:id,title');
                                        $query->with('attributeDetail.keys');
                                        $query->with('keyDetail:id,name');
                                    })
                                    ->where('id',$id)
                                    ->first();
            if (str_contains($variant->product->detailed_description,'storage/product/detail')){
                $var1 =  $variant->product->detailed_description;

                $filename = str_replace("storage/product/detail/", "", $var1);
                $file = Storage::disk('product')->get("detail/$filename");
                $variant['product']['detailed_description'] = (json_decode($file))->content;
                // get keys for product attributes

            }

//            die(str_contains($variant->product->detailed_description,'storage/product/detail'));
            $product = json_decode(json_encode($variant->product));
            $attributes = $given_attributes = array_unique(array_column($product->product_attributes , 'attribute_id'));
            $nattributes = [];

            foreach($attributes as $attribute){

                $nkeys = Attribute::where('id' , $attribute)->with('keys')->first();
                array_push($nattributes , $nkeys);
            }
            // return($nattributes);
            $attributes = $nattributes;

            // get selected keys
            $selected_attributes  = $product->product_attributes;
            $nselected_attributes = [];
            foreach($given_attributes as $at){
               $nselected_attributes[$at] = [];
            }
            foreach($selected_attributes as $attribute){


                if(in_array($attribute->attribute_id , $given_attributes) ){
                    array_push($nselected_attributes[$attribute->attribute_id] , $attribute->key_id);

                }
            }
            // return $nselected_attributes;
            $selected_attributes = $nselected_attributes;

            $warranty_periods = WarrantyPeriod::where('status',1)->get();

            $categories = Category::where('status',1)
                                    ->select('id','title')
                                    ->orderBy('title','asc')
                                    ->get();

            $brands  = Brand::select('id' ,  'name')->orderBy('name' , 'ASC') ->get();


            return response()->json([
                'status'    => 200,
                'variant'   => $variant,
                'warranty'  => $warranty_periods,
                'categories'=> $categories,
                'attributes' => $attributes,
                'selected_attributes' => $selected_attributes,
                'brands' => $brands
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |====================================================
    | Update the specified Vendor in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'category_id'       => 'required|integer',
            // 'subcategory_id'    => 'required|integer',
            'brand_id' => 'required|integer',
            'short_description' => 'required',
            'warranty_type' => 'required|integer',
            'package_weight' => 'required',
            'package_length' => 'required',
            'package_width' => 'required',
            'package_height' => 'required',
            'good_type' => 'integer'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        $product = Product::where('id', $id)->first();
//        dd(str_contains('storage/product/detail',$product->detailed_description));
//         return $product;
//
        if (str_contains($product->detailed_description,'storage/product/detail')){
            $var1 =  $product->detailed_description;
            $file_code = str_replace("storage/product/detail/", " ", $var1);

            // STORE PRODUCT DETAIL DESCRIPTION
            Storage::disk('product')->put("detail/$file_code", json_encode([
                'content' => $request->detailed_description,
            ]));

        }else{
            // STORE PRODUCT DETAIL DESCRIPTION
            $file_code = $this->randomStr(12);
            $file_code= $file_code.'.json';
            Storage::disk('product')->put("detail/$file_code", json_encode([
                'content' => $request->detailed_description,
            ]));
//            die($request->detailed_description);
        }


//        die('hit');
        // store primary image


        $primary_image = "";
        if ($request->input('primary_image')) {


            $primary_image = $request->input('primary_image'); //your base64 encoded data

            $primary_image = ApiHelper::uploadFile($primary_image, 'product', 'images', true);
        }


        // store images

        $i = 1;
        $detailimages = [];
        if ($request->input('files')) {

            foreach ($request->input('files') as $image) {
                $image_name = ApiHelper::uploadFile($image, 'product', 'images', true);
                array_push($detailimages, $image_name);
            }
        }


        //  return $detailimages;


        // PRODUCT-DETAILS
        $productData = [
            'name' => $request->name,
            // 'category_id'         => $request->category_id,
            // 'subcategory_id'      => $request->subcategory_id,
            // 'childcategory_id'    => $request->childcategory_id,
            'brand_id' => $request->brand_id,
            'store_id' => Auth::user()->store->id,
            'short_description' => $request->short_description,
            'detailed_description' => "storage/product/detail/$file_code",
            'package_contents' => $request->package_contents,
            'warranty_type' => $request->warranty_type,
            'warranty_period_id' => $request->warranty_period_id,
            'warranty_policy' => $request->warranty_policy,
            'package_weight' => $request->package_weight,
            'package_length' => $request->package_length,
            'package_width' => $request->package_width,
            'package_height' => $request->package_height,
            'good_type' => $request->good_type,
            'primary_image' => $primary_image == "" ? $product->primary_image : $primary_image
        ];

        if ($request->warranty_type == 1) {
            $productData['warranty_period_id'] = NULL;
        }


        // if ($request->primary_image) {
        //     $productData['primary_image'] = $request->primary_image;
        // }

        // VARIANT-DETAILS
        $variantData = [
            'availability' => $request->availability,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'quantity' => $request->quantity,
            'seller_sku' => $request->seller_sku,
        ];

        if ($request->sku_images_data) {
            $image = self::uploadFile($request->sku_images_data, 'public', 'product/variant/image');
            $variantData['image'] = $image;
        }

        $variant_id = $request->variant_id;

        DB::beginTransaction();
        try {

            Product::where('id', $id)->update($productData);
            ProductVariant::where('id', $variant_id)->update($variantData);

            // UPDATE DETAIL IMAGES
            // $images = $request->get('images');
            if ($detailimages) {
                foreach ($detailimages as $image) {
                    ProductImage::Create([
                        'product_id' => $id,
                        'image' => $image,
                    ]);
                }
            }

            // UPDATE PRODUCT-ATTRIBUTES
            $attributes = $request->get('attributes');
            if ($attributes) {
                ProductAttribute::where('product_id', $id)->delete();
                foreach ($attributes as $attribute => $keys) {
                    if ($keys) {
                        foreach ($keys as $key) {
                            ProductAttribute::Create([
                                'product_id' => $id,
                                'attribute_id' => $attribute,
                                'key_id' => $key,
                            ]);
                        }
                    }

                }
            }


            DB::commit();
            return response()->json([
                "status" => 200,
                "message" => "Product variant is updated successfully",

            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }


    }


    /*
    |=============================================================
    | Delete The Specified Product  From Storage -- Soft Delete
    |=============================================================
    */
    public function destroy($id)
    {
        try {
            Product::destroy($id);
            return response()->json([
                "status" => 200,
                "message" => "Product is deleted successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
   |=============================================================
   | Delete The Specified Product Variant From Storage -- Soft Delete
   |=============================================================
   */
    public function variantDelete($id)
    {
        try {
            ProductVariant::destroy($id);
            return response()->json([
                "status" => 200,
                "message" => "Product variant is deleted successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |=============================================================
    |  Delete Product-Detail-Image From Storage -- Soft Delete
    |=============================================================
    */
    public function deleteProductImage(Request $request)
    {
        try {
            ProductImage::where('id', $request->image_id)->delete();
            return response()->json([
                "status" => 200,
                "message" => "Product image is deleted successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    // Add new Variant
    public function addNewVariant(Request $request, $id)
    {
        // return $request->all();

        $image = null;
        if ($request->sku_images_data) {
            $image = self::uploadFile($request->sku_images_data, 'public', 'product/variant/image');
        }

        $variant = ProductVariant::Create([
            'product_id' => $request->id,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'quantity' => $request->quantity,
            'seller_sku' => $request->seller_sku,
            'availability' => $request->availability,
            'image' => $image
        ]);

        return response()->json([
            "status" => 200,
            "message" => "Product variant is updated successfully",
            "variant" => $variant
        ]);
    }

    public function editTranslation($id)
    {


        $product = Product::select('id', 'name', 'name_ar', 'short_description', 'short_description_ar', 'detailed_description',  'detailed_description_ar',  'status', 'translation_verified')->find($id);
        if (str_contains($product->detailed_description,'storage/product/detail')){
            $eng = $product->detailed_description;
            $filename = str_replace("storage/product/detail/", "", $eng);
            $file = Storage::disk('product')->get("detail/$filename");
            $product['detailed_description'] = (json_decode($file))->content;
        }
        if (str_contains($product->detailed_description_ar,'storage/product/detail')){
            $arabic =$product->detailed_description_ar;
            $filename_ar = str_replace("storage/product/detail/", "", $arabic);
            $file_ar = Storage::disk('product')->get("detail/$filename_ar");
            $product['detailed_description_ar'] = (json_decode($file_ar))->content;
        }
//        $product = json_decode(json_encode($product));
        return response()->json([
            'status'  => 200,
            'product' => $product
        ]);
    }

    public function updateTranslation(Request $request, $id)
    {
        
        // $product = ($request->all());
        $product = Product::find($id);

        if (str_contains($product->detailed_description,'storage/product/detail')){
            $eng =  $product->detailed_description;
            $file_code = str_replace("storage/product/detail/", "", $eng);
            // STORE PRODUCT DETAIL DESCRIPTION
            Storage::disk('product')->put("detail/$file_code", json_encode([
                'content' => $request->detailed_description,
            ]));
        }else{
            // STORE PRODUCT DETAIL DESCRIPTION
            $file_code = $this->randomStr(12);
            $file_code=$file_code.'.json';
            Storage::disk('product')->put("detail/$file_code", json_encode([
                'content' => $request->detailed_description,
            ]));
        }
        if (str_contains($product->detailed_description_ar,'storage/product/detail')){
            $arabic =  $product->detailed_description_ar;
            $file_code_ar = str_replace("storage/product/detail/", "", $arabic);
            Storage::disk('product')->put("detail/$file_code_ar", json_encode([
                'content' => $request->detailed_description_ar,
            ]));

        }else{
            $file_code_ar = $this->randomStr(12);
            $file_code_ar=$file_code_ar.'.json';
            Storage::disk('product')->put("detail/$file_code_ar", json_encode([
                'content' => $request->detailed_description_ar,
            ]));
        }
        $product->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'short_description' => $request->short_description,
            'short_description_ar' => $request->short_description_ar,
            'detailed_description' => "storage/product/detail/".$file_code,
            'detailed_description_ar' => "storage/product/detail/".$file_code_ar,
            'translation_verified' => $request->translation_verified ? 1 : 0
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Product Translation Updated ',
            'procuct' => $product,
            'request' => $request->all()
        ]);
    }

    public function changeStatus(Request $request)
    {
        $product = Product::where('id', $request->product_id);
        try {
            if ($request->has('status')) {
                Product::where('id', $request->product_id)->update(['status' => $request->status]);
            } elseif($request->has('featured')) {
                Product::where('id', $request->product_id)->update(['featured' => $request->featured]);
            } else {
                Product::where('id', $request->product_id)->update(['translation_verified' => $request->translation]);
            }
            return response()->json(['status' => 200, 'success' => 'Status changed successfully.', 'product' => $product,  'request' => $request->all()]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage(),

            ]);
        }
    }
}
