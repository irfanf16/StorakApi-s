<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailResource;
use Illuminate\Http\Request;

use App\Models\Product;

class AppProductsController extends Controller
{
    /*
    |============================================================
    | Get Product Details
    |============================================================
    */
    public function productDetails($id)
    {
        try {
            $product_details = Product::with('category:id,title,title_ar,slug')
                ->with('subcategory:id,title,title_ar,slug')
                ->with('childcategory:id,title,title_ar,slug')
                ->with('brand')
                ->with('firstVariant')
                ->with('variants.variantAttributes', function ($query) {
                    $query->with('attributeDetail:id,title,title_ar');
                    $query->with('keyDetail:id,name,name_ar');
                })
                ->with('images')
                ->with('store.products')
                ->find($id);
            $product_details->increment('views', 1);

            $product_details = ProductDetailResource::make($product_details);

            return response()->json([
                'status' => 200,
                'product' => $product_details,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


}
