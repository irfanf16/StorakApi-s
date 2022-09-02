<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderPackage;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class VendorCommissionController extends Controller
{
    public function commissionStructure()
    {
        try {
            $categories = Category::with('subcategories.childcategories.appliedCommission')->get();
            return response()->json([
                'status' => 200,
                'categories' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage()
            ]);
        }
    }
    public function itemsCommissions(){
        try {
            $orders = OrderPackage::where('store_id',\Auth::user()->store->id ?? 0)
                ->with('orderDetail')
                ->with('storeDetail')
                ->with('fulfillmentDetail')
                ->with('orderStatusDetail')
                ->with('packageItems.productDetail')
                ->with('packageItems.variantDetail')
                ->orderBy('id','ASC')
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

}
