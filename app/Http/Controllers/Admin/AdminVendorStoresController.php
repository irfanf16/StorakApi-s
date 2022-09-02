<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Image;

use App\Models\Store;
use App\Models\City;
use App\Models\Product;
use App\Models\User;


class AdminVendorStoresController extends Controller
{
    /*
    |===========================================================
    | Get Listing of All Vendor-Stores From Storage --
    |===========================================================
    */
    public function index()
    {
        try {
            $stores = Store::with('vendorDetails:id,name,email,mobile,is_mobile_verified,status')
                            ->get();

            $stores_count      = count($stores);
            $active_stores     = $stores->where('status',1)->count();
            $inactive_stores   = $stores->where('status',0)->count();
            $verified_stores   = $stores->where('is_verified',1)->count();
            $unverified_stores = $stores->where('is_verified',0)->count();
            $featured_stores   = $stores->where('featured',1)->count();

            return response()->json([
                'status'           => 200,
                'stores'           => $stores,
                'stores_count'     => $stores_count,
                'active_stores'    => $active_stores,
                'inactive_stores'  => $inactive_stores,
                'verified_stores'  => $verified_stores,
                'unverified_stores'=> $unverified_stores,
                'featured_stores'  => $featured_stores,
            ]);

        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }
    
    /*
    |============================================================
    | Get Required Data For Creating a New Vendor-Store -- 
    |============================================================
    */
    public function create()
    {
        try {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, you are not allowed to create vendor store",
            ]);
            
        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }


    /*
    |============================================================
    | Store a Newly Created Vendor-Store in Storage --
    |============================================================
    */ 
    public function store(Request $request)
    {
        try {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, you are not allowed to setup new vendor store",
            ]);
            
        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |==========================================================
    | Show Specified Vendor-Store From Storage --
    |==========================================================
    */
    public function show($id)
    {
        try {
            $store = Store::where('id', $id)
                            ->with('vendorDetails')
                            ->first();
            $products = Product::where('store_id', $id)->with('category:id,title', 'subCategory:id,title', 'childCategory:id,title')->get();
        
            return response()->json([
                'status' => 200,
                'store'  => $store,
                'products' => $products
            ]);

        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }

    /* 
    |==========================================================
    | Edit Specified Vendor-Store Details --
    |==========================================================
    */
    public function edit($id)
    {
        try {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, you are not allowed to edit vendor store details",
            ]);
            
        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }

    /* 
    |============================================================
    | Update The Specified Vendor-Store in Storage -- 
    |============================================================
    */
    public function update(Request $request, $id)
    {
        try {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, you are not allowed to update vendor store details",
            ]);
            
        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }

    /*
    |============================================================
    | Remove The Specified Vendor-Store From Storage --
    |============================================================
    */
    public function destroy($id)
    {
        try {
            $isDeactive = Store::where('id',$id)
                                ->update(['status' => 0]);

            if ($isDeactive) {

                return response()->json([
                    "status"  => 200,
                    "message" => "Store is de-activated Successfully",
                ]);
            }

            return response()->json([
                "status"  => 100,
                "message" => "Something Went Wrong",
            ]);

        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }
    
    public function changeStatus(Request $request)
    {
        try {
            if ($request->has('status')) {
                Store::where('id', $request->vendor_store_id)->update(['status' => $request->status]);
            } else {
                Store::where('id', $request->vendor_store_id)->update(['featured' => $request->featured]);
            }
            return response()->json(['status' => 200, 'success' => 'Status changed successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
