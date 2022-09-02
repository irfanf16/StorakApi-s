<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


use App\Models\Store;
use App\Models\ProductReview;


class VendorProductReviewsController extends Controller
{
    /*
    |==================================================================
    | Get Listing of All Reviews On Auth-Vendor Products
    |==================================================================
    */
    public function index(Request $request)
    {
        try {

            if ($request->ajaxRequest) {

                $product_ids = Product::where('store_id', Store::where('user_id', \Auth::id())->first()->id)->pluck('id');
                $reviews = ProductReview::with('productDetail', 'images')->whereIn('product_id', $product_ids)->where('status', 1)
                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                        $query->where('customer_review', 'LIKE', '%' . $request->search . "%");
                        $query->orWhere('vendor_reply', 'LIKE', '%' . $request->search . "%");
                    })
                    ->when($request->has('reviews') && $request->reviews == 0, function ($query) use ($request) {
                        $query->where('vendor_reply', '=', null);
                    })
                    ->when($request->has('reviews') && $request->reviews == 1, function ($query) use ($request) {
                        $query->where('vendor_reply', '!=', null);
                    })
                    ->paginate($request->datatable_length ?? 10);

                return response()->json([
                    'status' => 200,
                    'reviews' => $reviews,
                ]);
            }

            $product_ids = Product::where('store_id', Store::where('user_id', \Auth::id())->first()->id)->pluck('id');
            $reviews = ProductReview::whereIn('product_id', $product_ids)->where('status', 1)->get();
            $answer_reviews = $reviews->where('vendor_reply', '!=', null)->count();
            $pending_reviews = $reviews->where('vendor_reply', '=', null)->count();


            return response()->json([
                'status' => 200,
                'total_reviews' => count($reviews),
                'answer_reviews' => $answer_reviews,
                'pending_reviews' => $pending_reviews
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==============================================================
    | Save Auth-Vendor Reply To Customer Review
    |==============================================================
    */
    public function replyReview(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'review_id' => 'required|integer',
            'vendor_reply' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'vendor_reply' => $request->vendor_reply,
        ];

        try {
            ProductReview::where('id', $request->review_id)
                ->update($formData);

            // SEND PUSH-NOTIFICATION TO CUSTOMER
            // Write code here

            return response()->json([
                'status' => 200,
                'message' => "Your reply has been submitted successfully",
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }

    public function productReview($pid)
    {
        $all_reviews = ProductReview::with('images','productDetail:id,name,primary_image')
            ->where('product_id',$pid)
            ->get();
        $reviews_count=count($all_reviews);
        $answer_reviews   = ProductReview::where(['product_id' => $pid , 'status' => 1])->where('vendor_reply', '!=', null)->count();
        $pending_reviews = ProductReview::where(['product_id' => $pid , 'status' => 1])->where('vendor_reply', '=', null)->count();
        return response()->json([
            'status'      => 200,
            'reviews' => $all_reviews,
            'total_reviews' => $reviews_count,
            'answer_reviews' => $answer_reviews,
            'pending_reviews' => $pending_reviews
        ]);
    }
}
