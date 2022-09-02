<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\ProductReview;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


use App\Models\Store;


class VendorProductQuestionsController extends Controller
{
    /*
    |==================================================================
    | Get Listing of All Questions Asked From Auth Vendor
    |==================================================================
    */
    public function index(Request $request)
    {
        try{
            if ($request->ajaxRequest){

                $product_ids=Product::where('store_id',Store::where('user_id', \Auth::id())->first()->id)->pluck('id');
                $questions=ProductQuestion::with('productDetail')->whereIn('product_id',$product_ids)->where('status',1)
                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                        $query->where('customer_question', 'LIKE', '%' . $request->search . "%");
                        $query->orWhere('vendor_reply', 'LIKE', '%' . $request->search . "%");
                    })
                    ->when($request->has('reviews') && $request->reviews==0, function ($query) use ($request) {
                        $query->where('vendor_reply','=',null);
                    })
                    ->when($request->has('reviews') && $request->reviews==1, function ($query) use ($request) {
                        $query->where('vendor_reply','!=',null);
                    })
                    ->paginate($request->datatable_length ?? 10);

                return response()->json([
                    'status' => 200,
                    'questions' => $questions,
                ]);
            }
            $product_ids=Product::where('store_id',Store::where('user_id', \Auth::id())->first()->id)->pluck('id');
            $questions=ProductQuestion::whereIn('product_id',$product_ids)->where('status',1)->get();
            $answer_questions=$questions->where('vendor_reply','!=',null)->count();
            $pending_questions=$questions->where('vendor_reply','=',null)->count();
            return response()->json([
                'status' => 200,
                'total_questions' => count($questions),
                'answer_questions' => $answer_questions,
                'pending_questions' => $pending_questions
            ]);
        }
        catch (\Exception $e) {
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
        try{
            $categories = Category::where('status',1)
                                ->select('id','title')
                                ->orderBy('title','asc')
                                ->get();

            $warranty_periods = WarrantyPeriod::where('status',1)->get();

            $has_store = \Auth::user()->store ?? null;

            return response()->json([
                'status'     => 200,
                'categories' => $categories,
                'warranty'   => $warranty_periods,
                'store_info' => $has_store
            ]);

        }
        catch (\Exception $e) {
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
        try{
            $data = Category::select('id','title')
                            ->where('id',$request->id)
                            ->with('subcategories')
                            ->with('brands')
                            ->first();

            return response()->json([
                'status' => 200,
                'data'   => $data,
            ]);
        }

        catch (\Exception $e) {
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
        try{
            $results = SubCategory::select('id','title')
                                    ->where('id',$request->id)
                                    ->with('childcategories')
                                    ->with('attributes.keys')
                                    ->first();

            return response()->json([
                'status'  => 200,
                'results' => $results,
            ]);
        }

        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |===========================================================
    | Store a Newly Created Product In the Database
    |===========================================================
    */
    public function store(Request $request)
    {
        if (!(\Auth::user()->store)) {
            return response()->json([
                "status"  => 403,
                "message" => "Please create your store first.",
            ]);
        }

        $validator = \Validator::make( $request->all(), [
            'name'              => 'required|string|max:255',
            'category_id'       => 'required|integer',
            'subcategory_id'    => 'required|integer',
            'brand_id'          => 'required|integer',
            'short_description' => 'required|string|max:500',
            'warranty_type'     => 'required|integer',
            'package_weight'    => 'required|integer',
            'package_length'    => 'required|integer',
            'package_width'     => 'required|integer',
            'package_height'    => 'required|integer',
            'good_type'         => 'integer'

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'name'                => $request->name,
            'category_id'         => $request->category_id,
            'subcategory_id'      => $request->subcategory_id,
            'childcategory_id'    => $request->childcategory_id,
            'brand_id'            => $request->brand_id,
            'store_id'            => \Auth::user()->store->id,
            'short_description'   => $request->short_description,
            'detailed_description'=> $request->detailed_description,
            'package_contents'    => $request->package_contents,
            'warranty_type'       => $request->warranty_type,
            'warranty_period_id'  => $request->warranty_period_id,
            'warranty_policy'     => $request->warranty_policy,
            'package_weight'      => $request->package_weight,
            'package_length'      => $request->package_length,
            'package_width'       => $request->package_width,
            'package_height'      => $request->package_height,
            'good_type'           => $request->good_type,
            'primary_image'       => $request->primary_image
        ];
        if ($request->warranty_type == 1) {
            $productData['warranty_period_id'] = NULL;
        }

        DB::beginTransaction();
        try {
            // STORE PRODUCT
            $newProduct = new Product();
            $saveProduct= $newProduct->create($formData);

            // STORE PRODUCT-DETAIL IMAGES
            $images = $request->get('images');

            if($images) {
                foreach ($images as $key => $image) {
                    ProductImage::Create ([
                        'product_id' => $saveProduct->id,
                        'image'      => $image,
                    ]);
                }
            }

            // STORE PRODUCT-ATTRIBUTES
            $attributes = $request->get('attributes');
            if($attributes){
                foreach ($attributes as $key => $attribute) {
                    if ($attribute) {
                        ProductAttribute::Create ([
                            'product_id'   => $saveProduct->id,
                            'attribute_id' => $key,
                            'key_id'       => $attribute,
                        ]);
                    }
                }
            }

            // STORE PRODUCT-VARIANTS
            $prices         = $request->get('price');
            $special_prices = $request->get('special_price');
            $quantities     = $request->get('quantity');
            $seller_skus    = $request->get('seller_sku');
            $availabilities = $request->get('availability');
            $sku_attributes = $request->get('sku_attributes'); //ARRAY OF DYNAMIC-ATTRIBUTES

            for ($i=0; $i<count($prices); $i++) {
                // STORE PRODUCT VARIANT
                $saveVariant = ProductVariant::Create ([
                    'product_id'    => $saveProduct->id,
                    'price'         => $prices[$i],
                    'special_price' => $special_prices[$i],
                    'quantity'      => $quantities[$i],
                    'seller_sku'    => $seller_skus[$i],
                    'availability'  => $availabilities[$i],
                ]);

                if($sku_attributes){
                    // STORE VARIANT-ATTIRUBUTE
                    foreach ($sku_attributes as $sku_attr) {
                        VariantAttribute::Create ([
                            'product_variant_id'=> $saveVariant->id,
                            'attribute_id'      => $sku_attr,
                            'key_id'            => $request->input("$sku_attr")[$i],
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                "status"  => 200,
                "message" => "Product is Uploaded Successfully",
            ]);

        }

        catch (\Exception $e) {
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
        try{
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

            $warranty_periods = WarrantyPeriod::where('status',1)->get();

            $categories = Category::where('status',1)
                                    ->select('id','title')
                                    ->orderBy('title','asc')
                                    ->get();

            return response()->json([
                'status'    => 200,
                'variant'   => $variant,
                'warranty'  => $warranty_periods,
                'categories'=> $categories
            ]);
        }

        catch (\Exception $e) {
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
        $validator = \Validator::make( $request->all(), [
            'name'              => 'required|string|max:255',
            // 'category_id'       => 'required|integer',
            // 'subcategory_id'    => 'required|integer',
            'brand_id'          => 'required|integer',
            'short_description' => 'required|string|max:500',
            'warranty_type'     => 'required|integer',
            'package_weight'    => 'required|integer',
            'package_length'    => 'required|integer',
            'package_width'     => 'required|integer',
            'package_height'    => 'required|integer',
            'good_type'         => 'integer'

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        // PRODUCT-DETAILS
        $productData = [
            'name'                => $request->name,
            // 'category_id'         => $request->category_id,
            // 'subcategory_id'      => $request->subcategory_id,
            // 'childcategory_id'    => $request->childcategory_id,
            'brand_id'            => $request->brand_id,
            'store_id'            => \Auth::user()->store->id,
            'short_description'   => $request->short_description,
            'detailed_description'=> $request->detailed_description,
            'package_contents'    => $request->package_contents,
            'warranty_type'       => $request->warranty_type,
            'warranty_period_id'  => $request->warranty_period_id,
            'warranty_policy'     => $request->warranty_policy,
            'package_weight'      => $request->package_weight,
            'package_length'      => $request->package_length,
            'package_width'       => $request->package_width,
            'package_height'      => $request->package_height,
            'good_type'           => $request->good_type,
        ];

        if ($request->warranty_type == 1) {
            $productData['warranty_period_id'] = NULL;
        }

        if ($request->primary_image) {
            $productData['primary_image'] = $request->primary_image;
        }

        // VARIANT-DETAILS
        $variantData = [
            'availability'  => $request->availability,
            'price'         => $request->price,
            'special_price' => $request->special_price,
            'quantity'      => $request->quantity,
            'seller_sku'    => $request->seller_sku,
        ];

        $variant_id = $request->variant_id;

        DB::beginTransaction();
        try {

            Product::where('id', $id)->update($productData);
            ProductVariant::where('id', $variant_id)->update($variantData);

            // UPDATE DETAIL IMAGES
            $images = $request->get('images');
            if($images) {
                foreach ($images as $key => $image) {
                    ProductImage::Create ([
                        'product_id' => $id,
                        'image'      => $image,
                    ]);
                }
            }

            // UPDATE PRODUCT-ATTRIBUTES
            $attributes = $request->get('attributes');
            if($attributes){
                ProductAttribute::where('product_id', $id)->delete();
                foreach ($attributes as $key => $attribute) {

                    ProductAttribute::Create([
                        'product_id'   => $id,
                        'attribute_id' => $key,
                        'key_id'       => $attribute,
                    ]);

                }
            }

            DB::commit();
            return response()->json([
                "status"  => 200,
                "message" => "Product variant is updated successfully",
            ]);

        }

        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }


    }



    /*
    |=============================================================
    | Delete The Specified Product From Storage -- Soft Delete
    |=============================================================
    */
    public function destroy($id)
    {
        try {
            ProductVariant::destroy($id);
            return response()->json([
                "status"  => 200,
                "message" => "Product variant is deleted successfully",
            ]);
        }

        catch (\Exception $e) {
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
            ProductImage::where('id',$request->image_id)->delete();
            return response()->json([
                "status"  => 200,
                "message" => "Product image is deleted successfully",
            ]);
        }

        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }



}
