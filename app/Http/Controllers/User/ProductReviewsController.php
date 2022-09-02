<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\ProductReviewsResource;
use App\Models\Order;
use App\Models\Product;

use App\Models\ReviewImage;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Traits\ApiHelper;

class ProductReviewsController extends Controller
{
    use ApiHelper;

    /*
    |=================================================================
    | Get The Listing of Reviews Given in Past -- Submitted Reviews
    |=================================================================
    */
    public function pastReviews()
    {
        try {
            $past_reviews = ProductReview::where([
                'user_id' => Auth::id(),
                'status' => 1
            ])
                ->with([
                    'productDetail:id,name,slug,brand_id,primary_image,total_reviews,avg_rating,total_rating',
                    'productDetail.brand:id,name,slug',
                    'productDetail.firstVariant',
                    'images'
                ])
                ->orderBy('id', 'desc')
                ->paginate(10);

            return response()->json([
                'status' => 200,
                'past_reviews' => $past_reviews
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }


    /*
    |=================================================================
    | Get The Listing of Pending Reviews -- Pending Reviews
    |=================================================================
    */
    public function pendingReviews()
    {
        try {
            $pending_reviews = Order::where('user_id', Auth::id())
                ->with('orderPackages.storeDetail:id,store_name')
                ->with('orderPackages.packageItems', function ($query) {
                    $query->with([
                        'productDetail:id,name,slug,total_reviews,avg_rating,brand_id,primary_image',
                        'productDetail.brand:id,name,slug',
                        'variantDetail',
                    ]);
                })
                ->orderBy('id', 'DESC')
                ->get();


            return response()->json([
                'status' => 200,
                'pending_reviews' => $pending_reviews
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message" => 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }
    }

    public function reviewsPending()
    {
        try {

            $userReviewedProductIDs = ProductReview::where('user_id', Auth::id())->get()->pluck('product_id');
            $pending_reviews = Order::where('user_id',Auth::id())
                ->with('orderPackages.storeDetail:id,store_name')
                ->with('orderPackages.packageItems', function ($query) use ($userReviewedProductIDs) {
                    $query
                        ->with('productDetail.brand')
                        ->with('variantDetail')
                        ->with(['productDetail' => function ($q) use ($userReviewedProductIDs) {
                            $q->whereNotIn('id', $userReviewedProductIDs);
                        }]);
                })
                ->orderBy('id', 'DESC')
                ->get();
            $pending_reviews = ProductReviewsResource::collection($pending_reviews);
            return response()->json([
                'status' => 200,
                'pending_reviews' => $pending_reviews
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message" => 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }
    }

    /*
    |=================================================================
    | Submit Your Review --
    |=================================================================
    */
    public function submitReview(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|integer',
                'customer_rating' => 'required|integer|min:1|max:5',
                'customer_review' => 'required|string|max:1000',
                'images' => 'array'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->errors()->all()
                ]);
            }

            $formData = [
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'customer_rating' => $request->customer_rating,
                'customer_review' => $request->customer_review,
                'likes_on_review' => 0,
                'likes_on_reply' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];

            $is_already_reviewed = ProductReview::where([
                'product_id' => $request->product_id,
                'user_id' => Auth::id()
            ])
                ->first();

            if ($is_already_reviewed) {
                return response()->json([
                    "status" => 100,
                    "message" => "You have already submitted your review for this product",
                ]);
            }

            DB::beginTransaction();
            $submit_review = ProductReview::insertGetId($formData);


            // IF REVIEW HAS IMAGES
            if ($request->images) {

                $allowedImageExtension = ['jpeg', 'jpg', 'png'];
                $base64_images = $request->images;
                $errors = [];

                foreach ($base64_images as $image) {

                    $extension = explode('/', mime_content_type($image))[1];
                    $check = in_array($extension, $allowedImageExtension);

                    if ($check) {

                        // CONVERT IMAGE TO BASE-64
                        // $base64_image = self::file64($image);

                        // SAVE REVIEW-IMAGES IN STORAGE USING API HELPER
                        $image_name = self::uploadFile($image, 'public', '/images/products/reviews', true);

                        // SAVE IMAGE NAME IN DB
                        $review_image = new ReviewImage();
                        $review_image->product_review_id = $submit_review;
                        $review_image->image = $image_name;
                        $review_image->save();
                    } else {
                        return response()->json([
                            "status" => 200,
                            "message" => "Sorry, the image format is incorrect, only jpg, jpeg, png allowed",
                        ], 422);
                    }
                }
            }


            // UPDATE AVG-RATINGS OF PRODUCT
            $is_existing_product = Product::where('id', $request->product_id)->first();

            if ($is_existing_product) {
                $total_rating = $is_existing_product->total_rating + $request->customer_rating;
                $total_reviews = $is_existing_product->total_reviews + 1;
                $avg_rating = $total_rating / $total_reviews;

                Product::where('id', $request->product_id)
                    ->update([
                        'total_rating' => $total_rating,
                        'total_reviews' => $total_reviews,
                        'avg_rating' => round($avg_rating, 2),
                    ]);

                DB::commit();

                return response()->json([
                    "status" => 200,
                    "message" => "Product review is submitted successfully",
                ]);

            } else {
                return response()->json([
                    "status" => 100,
                    "message" => "Sorry, You are not allowed to Review This Product",
                ]);
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => 100,
                "message" => 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }

    }


}
