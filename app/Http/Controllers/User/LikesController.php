<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductLike;

class LikesController extends Controller
{
    /*
    |=================================================================
    | Get Liked Products Listing -- For Auth-User
    |=================================================================
    */
    public function likedProducts()
    {
        try{
            $likedProducts = ProductLike::where('user_id', Auth::id())
                                        ->with('productDetail', function($query){
                                            $query->with('category:id,title,slug');
                                            $query->with('subcategory:id,title,slug');
                                            $query->with('childcategory:id,title,slug');
                                            $query->with('brand:id,name,slug');
                                            $query->with('store:id,store_name');
                                            $query->with('firstVariant');
                                        })
                                        ->paginate(10);

            return response()->json([
                'status'  => 200,
                'likedProducts' => $likedProducts,
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
    | Unlike Product (Single) -- For Auth-User
    |=================================================================
    */
    public function unlikeSingleProduct(Request $request)
    {
        try{
            $product_like = ProductLike::where([
                                            'product_id' => $request->product_id,
                                            'user_id' => Auth::id()
                                        ])
                                        ->first();

            // CHECK IF AUTH-USER HAS LIKED THIS PRODUCT
            if($product_like){
                DB::beginTransaction();
                $product_like->delete();

                // DECREMENT PRODUCT-LIKE
                $decrement_like = Product::find($product_like->product_id);
                $decrement_like->decrement('likes', 1);
                DB::commit();

                return response()->json([
                    'status'  => 200,
                    'message' => "You have unliked this product",
                ]);

            }
            else{
                DB::rollback();
                return response()->json([
                    'status'  => 403,
                    'message' => "Access denied",
                ]);
            }
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
    | Unlike Products (Multiple) -- For Auth-User
    |=================================================================
    */
    public function unlikeMultipleProducts(Request $request)
    {
        try{
            $product_likes = ProductLike::whereIn('product_id', $request->product_id)
                                        ->where('user_id', Auth::id())
                                        ->get();

            // CHECK IF AUTH-USER HAS LIKED THIS PRODUCT
            if($product_likes){

                DB::beginTransaction();
                foreach ($product_likes as $like) {

                    // DELETE PRODUCT-LIKE
                    ProductLike::find($like->id)->delete();

                    // DECREMENT PRODUCT-LIKE
                    $decrement_like = Product::find($like->product_id);
                    $decrement_like->decrement('likes', 1);
                }

                DB::commit();
                return response()->json([
                    'status'  => 200,
                    'message' => "You have unliked this product",
                ]);
            }
            else{
                return response()->json([
                    'status'  => 403,
                    'message' => "Access denied",
                ]);
            }

        }
        catch (\Exception $e) {

            DB::rollback();
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }


}
