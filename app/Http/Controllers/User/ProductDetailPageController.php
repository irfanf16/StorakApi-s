<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailResource;
use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\ProductLike;
use App\Models\ProductReview;
use App\Models\ProductQuestion;

class ProductDetailPageController extends Controller
{
    /*
    |=================================================================
    | Get Product Details -- Product Detail Section
    |=================================================================
    */
    public function productDetails($id)
    {
        try {
            $product_details = Product::with('category:id,title,slug,title_ar')
                ->with('subcategory:id,title,slug,title_ar')
                ->with('childcategory:id,title,slug,title_ar')
                ->with('brand')
                ->with('firstVariant')
                ->with('variants.variantAttributes', function ($query) {
                    $query->with('attributeDetail:id,slug,title,title_ar');
                    $query->with('keyDetail:id,slug,name,name_ar');
                })
                ->with('productAttributes', function ($query) {
                    $query->with('attributeDetail:id,slug,title,title_ar');
                    $query->with('keyDetail:id,slug,name,name_ar');
                })
                ->with('images')
                ->with('store.products')
                ->withCount('mostSoldProducts')
                ->withCount('mostWishlistProducts')
                ->find($id);

            // INCREMENT PRODUCT-VIEWS COUNT
            $product_details->increment('views', 1);

            // $file = file_get_contents($product_details->detailed_description  );
            // $product_details['detailed_description'] = (json_decode($file))->content;
            $product_details = ProductDetailResource::make($product_details);

            return response()->json([
                'status' => 200,
                'product' => $product_details,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }

    public function productDetail($slug)
    {
        try {
            $product_details = Product::with('category:id,title,slug,title_ar')
                ->with('subcategory:id,title,slug,title_ar')
                ->with('childcategory:id,title,slug,title_ar')
                ->with('brand')
                ->with('firstVariant')
                ->with('variants.variantAttributes', function ($query) {
                    $query->with('attributeDetail:id,slug,title,title_ar');
                    $query->with('keyDetail:id,slug,name,name_ar');
                })
                ->with('productAttributes', function ($query) {
                    $query->with('attributeDetail:id,slug,title,title_ar');
                    $query->with('keyDetail:id,slug,name,name_ar');
                })
                ->with('images')
                ->with('store.products')
                ->withCount('mostSoldProducts')
                ->withCount('mostWishlistProducts')
                ->where('slug', $slug)->first();

            // INCREMENT PRODUCT-VIEWS COUNT
            $product_details->increment('views', 1);


            $product_details = ProductDetailResource::make($product_details);
            return response()->json([
                'status' => 200,
                'product' => $product_details,
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
    | Get All Product Reviews And Ratings Listings -- Reviews Section
    |=================================================================
    */
    public function productReviews($id)
    {
        try {
            $product_reviews = ProductReview::where([
                'product_id' => $id,
                'status' => 1
            ])
                ->with('images', 'userDetail:id,name')
                ->latest()
                ->paginate(10);

            return response()->json([
                'status' => 200,
                'product_reviews' => $product_reviews,
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
    | Get All Product Questions Listing -- Questions Section
    |=================================================================
    */
    public function productQuestions($id)
    {
        try {
            $product_questions = ProductQuestion::where([
                'product_id' => $id,
                'status' => 1,
            ])
                ->with('userDetail:id,name')
                ->latest()
                ->paginate(10);

            return response()->json([
                'status' => 200,
                'product_questions' => $product_questions,
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
    | Increment Product Likes -- For Login User Only
    |=================================================================
    */
    public function incrementProductLikes($id)
    {
        try {
            //CHECK IF AUTH-USER HAS ALREADY LIKED THIS PRODUCT
            $already_liked = ProductLike::where([
                'product_id' => $id,
                'user_id' => Auth::id()
            ])
                ->first();
            if ($already_liked) {
                return response()->json([
                    'status' => 100,
                    'message' => "You have already liked this product",
                ]);
            } else {
                DB::beginTransaction();
                ProductLike::create([
                    'product_id' => $id,
                    'user_id' => Auth::id()
                ]);

                // INCREMENT PRODUCT LIKES
                $product_likes = Product::find($id);
                $product_likes->increment('likes', 1);
                DB::commit();
            }

            return response()->json([
                'status' => 200,
                'message' => "You liked this product",
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }


    /*
    |=================================================================
    | Get Listing of Product All Review Images -- HasManyThrough
    |=================================================================
    */
    public function productReviewImages($product_id)
    {
        try {
            $review_images = Product::where([
                'id' => $product_id,
                'status' => 1
            ])
                ->select('id', 'name', 'slug')
                ->with('images')
                ->latest()
                ->paginate(20);

            return response()->json([
                'status' => 200,
                'review_images' => $review_images,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


}
