<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

use Illuminate\Support\Facades\Mail;
use App\Mail\sendOrderStatusEmail;

use App\Models\OrderShippingRequest;


class ShippingDeliverRequestsController extends Controller
{
    /*
    |==================================================================
    | Get Listing of All Orders-Shipping-Requests
    |==================================================================
    */
    public function shippingRequests()
    {
        try {
            $shipping_requests = OrderShippingRequest::all();

            dd($shipping_requests);

            // ORDERS COUNT
            $counters = [];
            $listing =  $shipping_requests->filter(function ($shipping_requests) {
                return $shipping_requests->order_status_id == $status->id;
            });

            $counters[$status->status] = $listing->count();
           

            return response()->json([
                'status'         => 200,
                'ready_to_ship' => $orders,
                'shipped'       => $order_count,
                'delivered'     => $orders_status,
            ]);
        }

        catch (\Exception $e) {
            return response()->json([
                'status'  => 100,
                'message' => $e->getMessage()
            ]);
        }

    }



    /* 
    |==========================================================
    | Order-Status Updated By Shipping Company
    |==========================================================
    */
    public function updateOrderStatus(Request $request, $id)
    {   
        // FIND BUYER-EMAIL (Get This Using "BelongsToThrough" Special Relation)
        $buyer_email = OrderPackage::where('id',$id)->first()->user->email;

        DB::beginTransaction();
        try {
            // UPDATE ORDER-PACKAGE STATUS
            OrderPackage::where('id', $id)
                        ->update(['order_status_id' => $request->order_status_id]);
            
            // STORE PACKAGE-HISTORY
            $is_already_existing = OrderPackageHistory::where([
                                                        'order_package_id' => $id, 
                                                        'order_status_id'  => $request->order_status_id
                                                      ])->first();

            if(!$is_already_existing) {
                OrderPackageHistory::create([
                    'order_package_id' => $id,
                    'order_status_id'  => $request->order_status_id
                ]);
            }


            // FIND PACKAGE-DETAILS
            $package_details = OrderPackage::where('id',$id)->first();
            
            // SEND EMAIL TO BUYER -- ON PACKAGE STATUS CHANGE
            // Mail::to($buyer_email)->send(new SendOrderEmail($package_details)); // Origional
            Mail::to('dev.shahzadmahota@gmail.com')->send(new sendOrderStatusEmail($package_details)); // Testing

            DB::commit();
            return response()->json([
                "status"          => 200,
                "message"         => "Order Status is Updated Successfully",
            ]);
           
        }
        
        catch (\Exception $e) {
            
            DB::rollback();
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage(),
            ]); 
        }

    }



}
