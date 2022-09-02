<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Coupon;
use App\Models\OrderPackage;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VendorDashboardController extends Controller
{
    /*
    |================================================================
    | Display The Listing of Stats For Vendor Dashboard
    |================================================================
    */
    public function index()
    {
        try{
            $orders_count       = OrderPackage::where('store_id', Auth::user()->store->id ?? null)->count();
            $delivered_orders   = OrderPackage::where('store_id', Auth::user()->store->id ?? null)
                                    ->with('orderStatusDetail')
                                    ->whereHas('orderStatusDetail',  function($q){
                                        $q->where('status' , 'Delivered');
                                    })
                                    ->count();
            $products_count     = Product::where('store_id', Auth::user()->store->id ?? null)->count();
            $coupons_count      = Coupon::where('store_id', Auth::user()->store->id ?? null)->count();

            // GET VENDOR-PROFILE-STATUS
            $user = new User();
            $profile_status = $user->getVendorProfileStatus();

            return response()->json([
                'status'            => 200,
                'orders_count'      => $orders_count,
                'delivered_orders'  => $delivered_orders,
                'products_count'    => $products_count,
                'coupons_count'     => $coupons_count,
                'profile_status'    => $profile_status
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
    |================================================================
    | Show the form for creating a new resource.
    |================================================================
    */
    public function create()
    {
        //
    }



    /*
    |================================================================
    | Store a newly created resource in storage.
    |================================================================
    */
    public function store(Request $request)
    {
        //
    }



    /*
    |================================================================
    | Display the specified resource.
    |================================================================
    */
    public function show($id)
    {
        //
    }



    /*
    |================================================================
    | Show the form for editing the specified resource.
    |================================================================
    */
    public function edit($id)
    {
        //
    }



    /*
    |================================================================
    | Update the specified resource in storage.
    |================================================================
    */
    public function update(Request $request, $id)
    {
        //
    }



    /*
    |================================================================
    | Remove the specified resource from storage.
    |================================================================
    */
    public function destroy($id)
    {
        //
    }
}