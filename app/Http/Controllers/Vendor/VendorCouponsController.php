<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Coupon;
use App\Models\Product;


class VendorCouponsController extends Controller
{
    /*
    |====================================================================
    | Get Listing of All Coupons For This Store
    |====================================================================
    */
    public function index()
    {
        $coupons = Coupon::withCount('productVariants')
                         ->where('store_id',\Auth::user()->store->id ?? null)
                         ->latest()
                         ->get();

        $coupons_count   = $coupons->count();
        $inactive_coupons= $coupons->where('status',"disable")->count();
        
        // ACTIVE COUPONS
        $date = Carbon::now();
        $active_coupons  = $coupons->where('status',"enable")
                                    ->where('remaining_coupons', ">", 0)
                                    ->where('expire_at', '>',  $date->toDateTimeString())
                                    ->count();

        // EXPIRED COUPONS
        $expired_coupons = Coupon::where('store_id',\Auth::user()->store->id ?? null)
                                 ->where('expire_at', '<',  $date->toDateTimeString())
                                 ->orWhere('remaining_coupons', 0)
                                 ->count();

        return response()->json([
            'status'           => 200,
            'coupons'          => $coupons,
            'coupons_count'    => $coupons_count,
            'active_coupons'   => $active_coupons,
            'inactive_coupons' => $inactive_coupons,
            'expired_coupons'  => $expired_coupons,
        ]);

    }



    /*
    |====================================================================
    | Get Listing of Product (SKU's) For SKU-Based Coupon
    |====================================================================
    */
    public function create()
    {
        $products = Product::where('store_id',\Auth::user()->store->id ?? null)
                            ->with('variants')
                            ->latest()
                            ->get();

        return response()->json([
            'status'   => 200,
            'products' => $products,
        ]);
    }


    
    /*
    |====================================================================
    | Store a Newly Created Coupon In the Database
    |====================================================================
    */ 
    public function store(Request $request)
    {   
        // IF AUTH-USER DON'T HAVE ANY STORE
        if (!\Auth::user()->store) {
            return response()->json([
                'status' => 403,
                'errors' => "Please setup your store first in order to create a coupon / voucher"
            ]);
        }
        
        $validator = \Validator::make($request->all(), [
            'title'          => 'required|string|max:255',
            'description'    => 'required|string|max:255',
            'apply_to'       => 'required|integer',
            'quantity'       => 'required|integer',
            'discount_type'  => 'required|integer',
            'discount_value' => 'required|integer',
            'minimum_order_value'=> 'required|integer',
            'per_user_limit' => 'required|integer',
            'start_at'       => 'required|date|after_or_equal:now',
            'expire_at'      => 'required|date|after_or_equal:start_at'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        // VALIDATE SKU-COUPON
        if ($request->apply_to == 2) {
            $validator = \Validator::make( $request->all(), [
                'product_variant_id' => 'required|array|min:1',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->messages()->all()
                ]);
            }
            $formData = ['product_variant_id' => $request->product_variant_id];
        }

        // VALIDATE UNIQUE-COUPON
        if (Coupon::where('code', "#" . \Auth::user()->store->id ."-" . $request->code)->first()){
            return response()->json([
                'status' => 100,
                'errors' => "The coupon code is already in use"
            ]);
        }

        $formData = [
            'store_id'           => \Auth::user()->store->id,  
            'title'              => $request->title,
            'description'        => $request->description,
            'apply_to'           => $request->apply_to,
            'code'               => "#" . \Auth::user()->store->id ."-" . $request->code,
            'quantity'           => $request->quantity,
            'discount_type'      => $request->discount_type,
            'discount_value'     => $request->discount_value,
            'minimum_order_value'=> $request->minimum_order_value,
            'status'             => 1,
            'remaining_coupons'  => $request->quantity,
            'per_user_limit'     => $request->per_user_limit,
            'start_at'           => $request->start_at,
            'expire_at'          => $request->expire_at,
        ];

        $sku = $request->product_variant_id;

        DB::beginTransaction();
        try {
            $new_coupon = new Coupon();
            $coupon_id  = $new_coupon->create($formData);

            $coupon_id->productVariants()->sync($sku);

            DB::commit();
            return response()->json([
                "status"  => 200,
                "message" => "Coupon is Created Successfully",
            ]); 
        } 

        catch (\Exception $e) {

            DB::rollback();
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage()
            ]); 
        }
        
        
    }



    /*
    |====================================================================
    | Get Specified Vendor From Storage For Read Only
    |====================================================================
    */
    public function show($id)
    {
        //
    }



    /* 
    |====================================================================
    | Get Specified Product From Storage For Edit
    |====================================================================
    */
    public function edit($id)
    {
        try {
            $coupon = Coupon::withCount('productVariants')
                            ->with('productVariants')
                            ->findOrFail($id);

            $products = Product::where('store_id',\Auth::user()->store->id ?? null)
                                ->with('variants')
                                ->latest()
                                ->get();
        
            return response()->json([
                'status'  => 200,
                'coupon'  => $coupon,
                'products'=> $products
            ]);
        } 
        catch (\Exception $e) {
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage()
            ]); 
        }

    }



    /* 
    |====================================================================
    | Update The Specified Coupon in Storage.
    |====================================================================
    */
    public function update(Request $request, $id)
    {   
        // IF AUTH-USER DON'T HAVE ANY STORE
        if (!\Auth::user()->store) {
            return response()->json([
                'status' => 403,
                'errors' => "Please setup your store first in order to create a coupon / voucher"
            ]);
        }
        
        $validator = \Validator::make($request->all(), [
            'title'          => 'required|string|max:255',
            'description'    => 'required|string|max:255',
            'apply_to'       => 'required|integer',
            'quantity'       => 'required|integer',
            'discount_type'  => 'required|integer',
            'discount_value' => 'required|integer',
            'minimum_order_value'=> 'required|integer',
            'status'         => 'required|boolean',
            'per_user_limit' => 'required|integer',
            'start_at'       => 'required|date|after_or_equal:now',
            'expire_at'      => 'required|date|after_or_equal:start_at'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        // VALIDATE SKU-COUPON
        if ($request->apply_to == 2) {
            $validator = \Validator::make( $request->all(), [
                'product_variant_id' => 'required|array|min:1',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->messages()->all()
                ]);
            }
            $formData = ['product_variant_id' => $request->product_variant_id];
        }

        // VALIDATE UNIQUE-COUPON
        // if (Coupon::where('code', "#" . \Auth::user()->store->id ."-" . $request->code)->count() > 1){
        //     return response()->json([
        //         'status' => 100,
        //         'errors' => "The coupon code is already in use"
        //     ]);
        // }

        $formData = [
            'store_id'           => \Auth::user()->store->id,  
            'title'              => $request->title,
            'description'        => $request->description,
            'apply_to'           => $request->apply_to,
            // 'code'               => "#" . \Auth::user()->store->id ."-" . $request->code,
            'quantity'           => $request->quantity,
            'discount_type'      => $request->discount_type,
            'discount_value'     => $request->discount_value,
            'minimum_order_value'=> $request->minimum_order_value,
            'status'             => $request->status,
            'coupon_used'        => 0,
            'per_user_limit'     => $request->per_user_limit,
            'start_at'           => $request->start_at,
            'expire_at'          => $request->expire_at,
        ];

        $sku = $request->product_variant_id;
        
        DB::beginTransaction();
        try {
            Coupon::where('id', $id)->update($formData);
            
            $edit_coupon = Coupon::findOrFail($id);
            $edit_coupon->productVariants()->sync($sku);
            
            DB::commit();
            return response()->json([
                "status"  => 200,
                "message" => "Coupon is Updated Successfully",
            ]); 
        } 

        catch (\Exception $e) {

            DB::rollback();
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage()
            ]); 
        }

    }



    /*
    |====================================================================
    | Remove The Specified Coupon From Storage.
    |====================================================================
    */
    public function destroy($id)
    {
        try {
           Coupon::where('id',$id)
                 ->update(['status' => 2]);

            return response()->json([
                'status' => 200,
                'coupon' => "Coupon is disabled successfully",
            ]);
        } 
        catch (\Exception $e) {
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage()
            ]); 
        }
    }




    /*
    |====================================================================
    | Update (Enable/Disable) Status of The Specified Coupon 
    |====================================================================
    */
    public function updateStatus(Request $request)
    {
        try {
            Coupon::where([
                        'id' => $request->coupon_id,
                        'store_id' => \Auth::user()->store->id
                    ])
                    ->update(['status' => $request->status]);

            return response()->json([
                'status' => 200,
                'coupon' => "Coupon status has been updated successfully",
            ]);
        } 
        catch (\Exception $e) {
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage()
            ]); 
        }
    }



}
