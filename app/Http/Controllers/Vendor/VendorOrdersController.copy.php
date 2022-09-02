<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

use Illuminate\Support\Facades\Mail;
use App\Mail\sendOrderStatusEmail;

use App\Models\Order;
use App\Models\OrderPackage;
use App\Models\OrderPackageHistory;
use App\Models\OrderStatus;
use App\Models\ShippingCompany;


class  VendorOrdersController extends Controller
{
    /*
    |==================================================================
    | Get Listing of All Orders For That Vendor
    |==================================================================
    */
    public function index()
    {
        try {
            $orders = OrderPackage::where('store_id',\Auth::user()->store->id ?? 0)
                                    ->with('orderDetail')
                                    ->with('storeDetail')
                                    ->with('fulfillmentDetail')
                                    ->with('orderStatusDetail')
                                    ->with('packageItems.productDetail')
                                    ->orderBy('id','desc')
                                    ->get();

            $order_count = count($orders);

            // ORDERS COUNT
            $counters = [];
            $orders_status = OrderStatus::all();

            foreach ($orders_status as $status) {

                $listing =  $orders->filter(function ($orders) use ($status){
                    return $orders->order_status_id == $status->id;
                });

                $counters[$status->status] = $listing->count();
            }

            return response()->json([
                'status'      => 200,
                'orders'      => $orders,
                'orders_count'=> $order_count,
                'order_status'=> $orders_status,
                'counters'    => $counters
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
    |==================================================================
    | Get Categories Listings For Create New Product Page
    |==================================================================
    */
    public function create()
    {

    }



    /*
    |==================================================================
    | Store a Newly Created Order In the Database
    |==================================================================
    */
    public function store(Request $request)
    {


    }



    /*
    |==================================================================
    | Get Specific Order Details
    |==================================================================
    */
    public function show($id)
    {
        try {
            $order = OrderPackage::where('id',$id)
                                ->with([
                                    'orderDetail' => function ($query) {
                                        $query->select('*');
                                    },
                                    'orderDetail.user' => function ($query) {
                                        $query->select('*');
                                    },
                                    'orderDetail.billingAddress.countryDetail' => function ($query) {
                                        $query->select('*');
                                    },
                                    'orderDetail.billingAddress.cityDetail' => function ($query) {
                                        $query->select('*');
                                    },
                                    'orderDetail.shippingAddress.countryDetail' => function ($query) {
                                        $query->select('*');
                                    },
                                    'orderDetail.shippingAddress.cityDetail' => function ($query) {
                                        $query->select('*');
                                    }
                                ])
                                ->with('storeDetail')
                                ->with('fulfillmentDetail')
                                ->with('orderStatusDetail')
                                ->with([
                                    'packageItems.productDetail.firstVariant.variantAttributes.attributeDetail:id,title',
                                    'packageItems.productDetail.firstVariant.variantAttributes.keyDetail:id,name'
                                ])
                                ->with('packageHistories.packageStatusDetail')
                                ->first();

            return response()->json([
                'status'=> 200,
                'order' => $order
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
    |==================================================================
    | Get Orders Listing Against Specific Order-Status
    |==================================================================
    */
    public function ordersByStatus($id)
    {
        try {
            $orders = OrderPackage::where([
                                            'store_id' => \Auth::user()->store->id ?? 0,
                                            'order_status_id' => $id
                                        ])
                                    ->with('orderDetail')
                                    ->with('storeDetail')
                                    ->with('fulfillmentDetail')
                                    ->with('orderStatusDetail')
                                    ->with('packageItems.productDetail')
                                    ->orderBy('id','desc')
                                    ->get();

            $order_count = count($orders);

            return response()->json([
                'status'     => 200,
                'orders'     => $orders,
                'order_count'=> $order_count
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
    |==================================================================
    | Edit Specific Order In Vendor Panel
    |==================================================================
    */
    public function edit($id)
    {

    }



    /*
    |==================================================================
    | PROVIDE ORDER-STATUS LISTING FOR ORDER UPDATE BY VENDOR
    |==================================================================
    */
    public function orderStatusListing(Request $request)
    {
        try {
            $order_status    = OrderPackage::where('id',$request->order_id)->first();
            $order_status_id = $order_status->order_status_id;

            switch ($order_status->orderStatusDetail->status) {

                case 'Pending':
                    $order_status = OrderStatus::where('status_for','vendors')
                                                ->take(3)
                                                ->get();
                    break;

                case 'Accepted':
                    $order_status = OrderStatus::where('status_for','vendors')
                                                ->where('status', '!=', 'Pending')
                                                ->where('status', '!=', 'Rejected')
                                                ->take(2)
                                                ->get();
                    break;

                default:
                    $order_status = OrderStatus::where('id', '=', $order_status_id)
                                                ->get();
                    break;
            }

            $goods_types = GoodsType::all();

            return response()->json([
                'status'       => 200,
                'order_status' => $order_status,
                'goods_types'  => $goods_types
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



    /*
    |==========================================================
    | ORDER-STATUS UPDATED BY VENDOR
    |==========================================================
    */
    public function updateOrderStatus(Request $request, $id)
    {
        // FIND BUYER-EMAIL (Get This Using "BelongsToThrough" Special Relation)
        $buyer_email = OrderPackage::where('id',$id)->first()->user->email;

        DB::beginTransaction();
        try {
            //FIND ORDER-STAUTS
            $order_status = OrderStatus::findorfail($request->order_status_id)->status;

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


            // SEND EMAIL TO BUYER
            // Mail::to($buyer_email)->send(new SendOrderEmail($package_details)); // Origional
            // Mail::to('dev.shahzadmahota@gmail.com')->send(new sendOrderStatusEmail($package_details)); // Testing

            // SHIPPING-COMPANY INTERACTIONS
            if ($order_status == 'Ready to Ship') {

                $goods_type = $this->findGoodsNature($request->goods_types);


                $shipping_company = ShippingCompany::first();

                OrderShippingRequest::create([
                    'shipping_company_id'    => $shipping_company->id,
                    'order_package_id'       => $id,
                    'package_no'             => $$package_details->package_no,
                    'goods_type'             => $goods_type,
                    'order_status_id'        => $request->order_status_id,
                    'fulfillment_id'         => $package_details->fulfillment_id,
                    'fulfillment_charges'    => $package_details->fulfillment_charges,
                    'order_bill'             => $request->package_bill,
                    'payment_method'         => $package_details->orderDetail->payment_method,
                    'total_receivable_amount'=> $package_details->package_bill + $package_details->fulfillment_charges,
                ]);

                // Mail::to($shipping_company->email)->send(new SendOrderEmail($package_details)); // Origional
                Mail::to('dev.shahzadmahota@gmail.com')->send(new sendOrderStatusEmail($package_details)); // Testing
            }


            DB::commit();
            return response()->json([
                "status"  => 200,
                "message" => "Order Status is Updated Successfully",
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



    /*
    |======================================================
    | GENERATE NEW PACKAGE-NUMBER
    |======================================================
    */
    public function findGoodsNature($goods_types)
    {
        $goods_nature = "";
        foreach ($goods_types as $type) {
            $goods_nature = $goods_nature . GoodsType::where('id',$type->id)->first()->title;
        }
        return $goods_nature;
    }



    /*
    |====================================================
    | Remove the specified Vendor from storage.
    |====================================================
    */
    public function destroy($id)
    {

    }


}
