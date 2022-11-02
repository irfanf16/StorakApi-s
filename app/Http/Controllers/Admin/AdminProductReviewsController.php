<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\ProductReview;


class AdminProductReviewsController extends Controller
{
    /*
    |=================================================================
    | Get Listing of All Reviews On Products
    |=================================================================
    */
    public function index($pid)
    {
        try{
            $all_reviews = ProductReview::with('productDetail:id,name', 'userDetail:id,name')
                ->where('product_id',$pid)
                                        ->get();
            $reviews_count=count($all_reviews);
            $active_reviews   = ProductReview::where(['product_id' => $pid , 'status' => 1])->count();
            $inactive_reviews = ProductReview::where(['product_id' => $pid , 'status' => 0])->count();
            return response()->json([
                'status'      => 200,
                'reviews' => $all_reviews,
                'reviews_count' => $reviews_count,
                'active_reviews' => $active_reviews,
                'inactive_reviews' => $inactive_reviews,
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }

    public function reviewsList(Request $request){
        // try {


                $reviews = ProductReview::with('productDetail:id,name,slug', 'userDetail', 'images')->whereHas('productDetail')
                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                        $query->where('customer_review', 'LIKE', '%' . $request->search . "%");
                        $query->orWhere('vendor_reply', 'LIKE', '%' . $request->search . "%");
                    })
                    ->when($request->has('store_id') && $request->filled('store_id'), function ($query) use ($request) {
                        $query->whereIn('product_id', Product::where('store_id', $request->store_id)->pluck('id'));
                    })
                    ->when($request->has('from_date') && $request->filled('from_date'), function($query) use($request){
                        $query->where('created_at' , '>', $request->from_date);
                    })
                    ->when($request->has('to_date') && $request->filled('to_date'), function($query) use($request){
                        $query->where('created_at' , '<', $request->to_date);
                    })
                    ->when($request->has('status') && $request->filled('status'), function($query) use($request){
                        $query->where('status' , '=' , $request->status);
                    })
                    ->when($request->has('reviews') && $request->reviews == 0, function ($query) use ($request) {
                        $query->where('vendor_reply', '=', null);
                    })
                    ->when($request->has('reviews') && $request->reviews == 1, function ($query) use ($request) {
                        $query->where('vendor_reply', '!=', null);
                    })
                    ->paginate($request->datatable_length ?? 10);

                    $productReviews = ProductReview::all();
                    $answer_reviews = $productReviews->where('vendor_reply', '!=', null)->count();
                    $pending_reviews = $productReviews->where('vendor_reply', '=', null)->count();
                    $active_reviews = $productReviews->where('status', 1)->count();
                    $inactive_reviews = $productReviews->where('status', 0)->count();
                    $stores=Store::where('status',1)->get();
                return response()->json([
                    'status' => 200,
                    'reviews' => $reviews,
                    'total_reviews' => count($productReviews),
                    'answer_reviews' => $answer_reviews,
                    'pending_reviews' => $pending_reviews,
                    'active_reviews' => $active_reviews,
                    'inactive_reviews' => $inactive_reviews,
                    'stores' => $stores
                ]);
    }


    /*
    |=================================================================
    | Filter Customer's Reviews Listing (on Product)
    |=================================================================
    */
    public function filteredReviews(Request $request)
    {
        try{
            $per_page_results= $request->per_page_results;
            $filters = $request->except('per_page_results');

            // GET APPLIED-FILTERS FROM REQUEST OBJECT
            $applied_filters = [];
            foreach ($filters as $key => $request) {
                if ($request) {
                    $applied_filters[$key] = $request;
                }
            }

            // CONDIONAL QUERYING
            $filtered_reviews = ProductReview::where($applied_filters)
                                             ->with('productDetail:id,name', 'userDetail:id,name', 'images')
                                             ->paginate($per_page_results ?? 10);

            return response()->json([
                'status'           => 200,
                'filtered_reviews' => $filtered_reviews,
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
    |=================================================================
    | Get Customer's Review (on Product) Details
    |=================================================================
    */
    public function reviewDetail($id)
    {
        try{
            $review_detail = ProductReview::where('id', $id)
                                            ->with('productDetail', 'userDetail', 'images')
                                            ->first();

            return response()->json([
                'status'        => 200,
                'review_detail' => $review_detail
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
    |=================================================================
    | Change Customer's Review (on Product) Status
    |=================================================================
    */
    public function changeReviewStatus(Request $request, $id)
    {
        try{
            ProductReview::where('id', $id)
                        ->update(['status' => $request->status]);

            return response()->json([
                'status'  => 200,
                'message' => "Review status is changed successfully"
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            ProductReview::where('id', $request->review_id)->update(['status' => $request->status]);
            return response()->json(['status' => 200, 'success' => 'Status changed successfully.', 'request' => $request->all()]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage(),
            ]);
        }
    }


}
