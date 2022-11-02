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


class VendorOrdersController extends Controller
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
                                    'packageItems.productDetail.firstVariant.variantAttributes.keyDetail:id,name',
                                    'packageItems.variantDetail.variantAttributes.attributeDetail:id,title',
                                    'packageItems.variantDetail.variantAttributes.keyDetail:id,name',
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
//                                                ->where('status', '!=', 'Rejected')
                                                ->take(3)
                                                ->get();
                    break;

                case 'Rejected':
                    $order_status = OrderStatus::where('status', '=', 'Rejected')
                                                ->take(1)
                                                ->get();
                    break;

                case 'Cancelled':
                    $order_status = OrderStatus::where('status', '=', 'Cancelled')
                        ->take(1)
                        ->get();
                    break;

                case 'Shipped':
                        $order_status_a = OrderStatus::where('status_for','vendors')
                                                    ->where('id', '>=', $order_status->order_status_id)
                                                    ->take(3)
                                                    ->get()->toArray();
                    $order_status_b = OrderStatus::where('status', '=', 'Rejected')
                        ->take(1)
                        ->get()->toArray();
                    $order_status=array_merge($order_status_a,$order_status_b);
                        break;

                case 'Delivered':
                    $order_status = OrderStatus::where('status', '=', 'Delivered')
                                                ->take(1)
                                                ->get();
                    break;

                case 'Returned':
                        $order_status = OrderStatus::where('status', '=', 'Returned')
                                                    ->take(1)
                                                    ->get();
                        break;

                default:
                    $order_status_a = OrderStatus::where('status_for','vendors')
                                                ->where('id', '>=', $order_status->order_status_id)
                                                ->take(2)
                                                ->get()->toArray();
                    $order_status_b = OrderStatus::where('status', '=', 'Rejected')
                        ->take(1)
                        ->get()->toArray();
                    $order_status=array_merge($order_status_a,$order_status_b);
                    break;
            }

            return response()->json([
                'status'       => 200,
                'order_status' => $order_status
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
    | ORDER-STATUS BY UPDATED BY VENDOR
    |==========================================================
    */
    public function updateOrderStatus(Request $request, $id)
    {
        // FIND BUYER-EMAIL (GOT THIS USING BelongsToThrough Relation)
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

                // FIND PACKAGE-DETAILS
                $package_details = OrderPackage::where('id',$id)->first();

                // SEND EMAIL TO BUYER -- ON PACKAGE STATUS CHANGE
                // Mail::to('dev.shahzadmahota@gmail.com')->send(new SendOrderStatusEmail($package_details)); // Testing
                Mail::to($buyer_email)->send(new SendOrderStatusEmail($package_details)); // Origional
            }


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
