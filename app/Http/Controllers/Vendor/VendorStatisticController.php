<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorStatisticController extends Controller
{
    public function index(Request $request){

//        try {

            $has_store = Auth::user()->store ?? null;
        return response()->json([
            'status' => 200,
            'products' => $request->all(),
            'store'=>Auth::user()->store
        ]);
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
            return response()->json([
                'status' => 200,
                'products' => $products,
            ]);

//        } catch (\Exception $e) {
//            return response()->json([
//                "status" => 100,
//                "errors" => $e->getMessage()
//            ]);
//        }


    }
}
