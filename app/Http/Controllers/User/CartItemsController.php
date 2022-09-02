<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\Variant;
use App\Models\WishlistItem;

class CartItemsController extends Controller
{
    /*
    |==================================================================
    | Get Listing of All Shopping Cart-Items -- Buyer
    |==================================================================
    */
    public function index(Request $request)
    {
        try {
            $data = CartItem::where('user_id', Auth::id())
                                    ->with([
                                        'productDetail:id,name,name_ar,store_id,primary_image,slug',
                                        'productDetail.store:id,store_name,store_name_ar,slug'
                                    ])
                                    ->with('variantDetail')
                                    // ->with('variantDetail.productAttributes', function($query){
                                    //     $query->with('attributeDetail:id,title');
                                    //     $query->with('keyDetail:id,name');
                                    // })
                                    ->get()
                                    ->makeHidden('user_id');
            $cart_items=CartResource::collection($data);
            $stores=[];
            foreach ($cart_items as $item){
                if ($request->header('lang')=='ar'){
                    $stores[]=$item->productDetail->store->store_name_ar;

                }else{
                    $stores[]=$item->productDetail->store->store_name;
                }
            }
//            $stores = $cart_items->pluck('productDetail')
//                                 ->pluck('store')
//                                 ->pluck('store_name')
//                ->when($request->header('lang')=='ar',function ($query){
//                    $query->pluck('store_name_ar');
//                })
            ;

            $stores = array_unique($stores);
            return response()->json([
                'status'     => 200,
                'cart_items' => $cart_items,
                'items_count'=> $cart_items->count(),
                'stores'     => array_values($stores)
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
    |=====================================================================
    | Add Single Item To Shopping Cart -- Buyer
    |=====================================================================
    */
    public function store(Request $request)
    {
        try {

            $variant = ProductVariant::where('id' , $request->product_variant_id)->first();

            CartItem::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_variant_id' => $request->product_variant_id
                ],
                [
                    'user_id'           => Auth::id(),
                    'product_id'        => $request->product_id,
                    'product_variant_id'=> $request->product_variant_id,
                    'quantity'          => $request->quantity,
                    'price'             => $variant->special_price,
                ]
            );

            return response()->json([
                'status' => 200,
                'message'=> "A new item has been added to your Shopping Cart.",
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
    |=====================================================================
    | Add Multiple-Items To Shopping Cart -- Buyer
    |=====================================================================
    */
    public function addMultipleItems(Request $request)
    {
        try {
            foreach ($request->items as $key => $item) {
                $variant = ProductVariant::where('id' , $item['product_variant_id'])->first();

                CartItem::updateOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'product_variant_id' => $item['product_variant_id']
                    ],
                    [
                        'user_id'           => Auth::id(),
                        'product_id'        => $item['product_id'],
                        'product_variant_id'=> $item['product_variant_id'],
                        'quantity'          => $item['quantity'],
                        'price'             => $variant->special_price,
                    ]
                );
            }

            $updatedCart = new CartItem();

            return response()->json([
                'status'  => 200,
                'message' => $updatedCart->myCart(),
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
    |=====================================================================
    | Add Multiple-Items To Shopping Cart -- Mobile-App -- Buyer
    |=====================================================================
    */
    public function addMultipleItemsApp(Request $request)
    {
        try {
            foreach ($request->items as $key => $item) {
                $variant = ProductVariant::where('id' , $item['product_variant_id'])->first();

                CartItem::updateOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'product_variant_id' => $item['product_variant_id']
                    ],
                    [
                        'user_id'           => Auth::id(),
                        'product_id'        => $item['product_id'],
                        'product_variant_id'=> $item['product_variant_id'],
                        'quantity'          => $item['quantity'],
                        'price'             => $variant->special_price,

                    ]
                );
            }

            $updatedCart = new CartItem();

            return response()->json([
                'status'  => 200,
                'message' => "Cart is updated successfully"
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
    |=====================================================================
    | Remove Single-Item From Shopping Cart -- Buyer
    |=====================================================================
    */
    public function destroy($id)
    {
        try {
            if (is_array($id)){
                CartItem::destroy($id);
            }
            else{
                CartItem::findOrFail($id)->delete();
            }

            return response()->json([
                'status' => 200,
                'message'=> "The selected item has been removed from your Shopping Cart",
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
    |=====================================================================
    | Remove Multiple-Items From Shopping Cart -- Buyer
    |=====================================================================
    */
    public function removeMultipleItems(Request $request)
    {
        try {
            CartItem::destroy($request->item);

            return response()->json([
                'status' => 200,
                'message'=> "The selected items have been removed from your Shopping Cart",
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
    | Remove All Items From Shopping Cart -- Empty Buyer's Cart
    |=====================================================================
    */
    public function emptyCart()
    {
        try {
            CartItem::where('user_id', Auth::id())
                    ->delete();

            return response()->json([
                'status' => 200,
                'message'=> "Your shopping cart is empty now",
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
    | Remove Single Item From "Shopping Cart" And Add It To "Wishlist"
    |=====================================================================
    */
    public function cartToWishlist(Request $request)
    {
        try {
            DB::beginTransaction();
            {
                CartItem::findOrFail($request->id)->delete();
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

            }
            DB::commit();
            return response()->json([
                'status' => 200,
                'message'=> "Selected item has been moved to your wishlist",
            ]);

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
