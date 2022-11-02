<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\StockHistory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Image;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductsVariant;


class AdminProductVariantsController extends Controller
{
    /*
    |==================================================
    | Get Listing of All Products
    |==================================================
    */
    public function index($pid)
    {
        $product = Product::where('id',$pid)
                          ->select('id','name','short_description','detailed_description')
                          ->first();

        $variants = ProductVariant::with('product:id,name')

                                //    ->with('variantAttributes:id,title')
                                //    ->with('variant:id,title')
                                   ->where('product_id',$pid)
                                   ->get();

        $total_stock     = ProductVariant::where('product_id',$pid)->sum('quantity');
        $sold_stock     = ProductVariant::where('product_id',$pid)->sum('sold_stock');
        // $remaining_stock = ProductVariant::where('product_id',$pid)->sum('remaining_stock');
        $variants_count = count($variants);

        return response()->json([
            'status'         => 200,
            'product'        => $product,
            'variants'       => $variants,
            'total_stock'    => $total_stock,
            'sold_stock'    => $sold_stock,
            // 'remaining_stock'=> $remaining_stock,
            'variants_count' => $variants_count,
        ]);
    }



    /*
    |===================================================
    | Get Listings For Create New Product page
    |===================================================
    */
    public function create($pid)
    {
        $product    = Product::where('id',$pid)->first();
        $attributes = Attribute::where('status',1)
                                ->select('id','title')
                                ->orderBy('title','asc')
                                ->get();

        return response()->json([
            'status'     => 200,
            'product'    => $product,
            'attributes' => $attributes
        ]);
    }



    /*
    |====================================================
    | Store a newly created Vendor in storage.
    |====================================================
    */
    public function store(Request $request, $pid)
    {
        $validator = \Validator::make( $request->all(), [
            'attribute_id'   => 'required|integer',
            'variant_id'     => 'required|integer',
            'retail_price'   => 'required|integer',
            'sale_price'     => 'required|integer',
            'sku'            => 'required|string|max:100',
            'total_stock'    => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }


        $formData = [
            'product_id'     => $pid,
            'attribute_id'   => $request->attribute_id,
            'variant_id'     => $request->variant_id,
            'retail_price'   => $request->retail_price,
            'sale_price'     => $request->sale_price,
            'sku'            => $request->sku,
            'total_stock'    => $request->total_stock,
            'remaining_stock'=> $request->total_stock,
        ];

        $productsVariant = new ProductsVariant();
        $isSaved         = $productsVariant->create($formData);

        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Product Variant is Added Successfully",
            ]);

        }

        else{
            return response()->json([
                "status"  => 100,
                "message" => "Sorry! Something Went Wrong",
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
    | Get Specified Vendor from storage For Editing
    |==========================================================
    */
    public function edit($pid, $vid)
    {

    }



    /*
    |====================================================
    | Update the specified Vendor in storage.
    |====================================================
    */
    public function update(Request $request, $pid, $vid)
    {

    }



    /*
    |====================================================
    | Remove the specified Vendor from storage.
    |====================================================
    */
    public function destroy($pid, $vid)
    {
        $isDeleted = ProductsVariant::where('id',$vid)->delete();

        if ($isDeleted) {
            return response()->json([
                "status"  => 200,
                "message" => "Product Variant is Deleted Successfully",
            ]);
        }
        return response()->json([
            "status"  => 100,
            "message" => "Something Went Wrong",
        ]);
    }



    /*
    |====================================================
    | Add New Stock For Specified Product-Variant
    |====================================================
    */
    public function addStock(Request $request, $pid, $vid)
    {
        $validator = \Validator::make( $request->all(), [
            'add_stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all(),
            ]);
        }
        if ($request->has('price')){
            $addStock = ProductVariant::where('id', $vid)
                ->update([
                    'quantity'    => DB::raw("quantity+$request->add_stock"),
                    'price'    => $request->price,
                    'special_price'    => $request->special_price,
                ]);
        }else{
            $addStock = ProductVariant::where('id', $vid)
                ->update([
                    'quantity'    => DB::raw("quantity+$request->add_stock"),
                ]);
        }
        $addStock = ProductVariant::find($vid);

        StockHistory::create([
            'product_variant_id'=>$addStock->id,
            'price'=>$addStock->price,
            'special_price'=>$addStock->special_price,
            'stock'=>$request->add_stock,
            'added_by'=>'Storak Admin',
        ]);


        // $addStock = ProductsVariant::where('id',$vid)->increment('total_stock', $request->add_stock);
        // $addStock = ProductsVariant::where('id',$vid)->increment('remaining_stock', $request->add_stock);

        if ($addStock) {
            return response()->json([
                "status"  => 200,
                "message" => "New Stock Added For Product-Variant Successfully",
            ]);

        }
        else{
            return response()->json([
                "status"  => 100,
                "message" => "Sorry! Something Went Wrong",
            ]);
        }

    }


}
