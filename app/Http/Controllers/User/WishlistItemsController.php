<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\WishlistItem;

class WishlistItemsController extends Controller
{
    /*
    |==========================================================
    | Get Listing of All Wishlist-Items -- Buyer (Auth User)
    |==========================================================
    */
    public function index()
    {
        try {
            $wishlist_items = WishlistItem::where('user_id', Auth::id())
                                            ->with([
                                                'productDetail:id,name,slug,store_id,primary_image',
                                                'productDetail.store:id,store_name'
                                            ])
                                            ->with('variantDetail')
                                            ->get()
                                            ->makeHidden('user_id');

            return response()->json([
                'status'         => 200,
                'wishlist_items' => $wishlist_items,
                'items_count'    => $wishlist_items->count()
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
    |==========================================================
    | Add Item To Wishlist -- Buyer (Auth User)
    |==========================================================
    */
    public function store(Request $request)
    {
        try {

            $wishlist=WishlistItem::where([
                'user_id'           => Auth::id(),
                'product_id'        => $request->product_id,
                'product_variant_id'=> $request->product_variant_id,
            ])->first();

            if ($wishlist){
                $wishlist->delete();
                return response()->json([
                    'status' => 200,
                    'message'=> "The selected item has been removed from your Wishlist",
                ]);
            }
            WishlistItem::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_variant_id' => $request->product_variant_id
                ],
                [
                    'user_id'           => Auth::id(),
                    'product_id'        => $request->product_id,
                    'product_variant_id'=> $request->product_variant_id,
                ]
            );
            return response()->json([
                'status' => 200,
                'message'=> "A new item has been added to your Wishlist",
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
    |==========================================================
    | Remove Item From Wishlist -- Buyer (Auth User)
    |==========================================================
    */
    public function destroy($id)
    {
        try {
            if (is_array($id)){
                WishlistItem::destroy($id);
            }
            else{
                WishlistItem::findOrFail($id)->delete();
            }

            return response()->json([
                'status' => 200,
                'message'=> "The selected item has been removed from your Wishlist",
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
    |=====================================================================
    | Remove Multiple-Items From Wishlist -- Buyer (Auth User)
    |=====================================================================
    */
    public function removeMultipleItems(Request $request)
    {
        try {
            WishlistItem::destroy($request->item);

            return response()->json([
                'status' => 200,
                'message'=> "The selected items have been removed from your Wishlist",
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
    |=====================================================================
    | Remove All Items From Wishlist -- Empty Buyer's Wishlist
    |=====================================================================
    */
    public function emptyWishlist()
    {
        try {
            WishlistItem::where('user_id', Auth::id())
                        ->delete();

            return response()->json([
                'status' => 200,
                'message'=> "Your Wishlist is empty now",
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
