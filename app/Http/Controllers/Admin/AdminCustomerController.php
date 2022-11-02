<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminCustomerController extends Controller
{
    public function allCustomers(Request $request)
    {
        try {
            $customers = User::where('role_id', 3)
                ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . "%");
                    $query->orWhere('email', 'LIKE', '%' . $request->search . "%");
                    $query->orWhere('country_code', 'LIKE', '%' . $request->search . "%");
                    $query->orWhere('mobile', 'LIKE', '%' . $request->search . "%");
                })
                ->when($request->has('status') && $request->filled('status'), function ($query) use ($request) {
                    $query->where('status', '=', $request->status);
                })
                ->when($request->has('from_date') && $request->filled('from_date'), function ($query) use ($request) {
                    $query->where('created_at', '>=', $request->from_date);
                })
                ->when($request->has('from_to') && $request->filled('from_to'), function ($query) use ($request) {
                    $query->where('created_at', '<=', $request->from_to);
                })
                ->latest()
                ->paginate($request->datatable_length);

            return response()->json([
                'status' => 200,
                'customers' => $customers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $customer = User::where(['id' => $id, 'role_id' => 3])->with('addresses.countryDetail', 'addresses.cityDetail', 'addresses.addressType', 'orders', 'productQuestions', 'productReviews')->first();
        $cartItems = CartItem::where('user_id', $id)
            ->with([
                'productDetail:id,name,name_ar,store_id,primary_image,slug',
                'productDetail.store:id,store_name,store_name_ar,slug'
            ])
            ->with('variantDetail')
            ->get();

        $wishlistItems = WishlistItem::where('user_id', $id)
            ->with([
                'productDetail:id,name,slug,store_id,primary_image',
                'productDetail.store:id,store_name'
            ])
            ->with('variantDetail')
            ->get();

        return response()->json([
            'status' => 200,
            'customer' => $customer,
            'cartItems' => $cartItems,
            'wishlistItems' => $wishlistItems,
        ]);
    }

    public function changeStatus(Request $request)
    {
        try {
            User::where('id', $request->user_id)->update(['status' => $request->status]);
            return response()->json(['status' => 200, 'success' => 'Status changed successfully.', 'request' => $request->all()]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage(),

            ]);
        }
    }

    public function wishlist(Request $request)
    {
        try {
            $wishlistItems = WishlistItem::with('productDetail', 'userDetail:id,name,email,mobile')->whereHas('productDetail')
                ->when($request->has('from_date') && $request->filled('from_date'), function ($query) use ($request) {
                    $query->where('created_at', '>=', $request->from_date);
                })
                ->when($request->has('from_to') && $request->filled('from_to'), function ($query) use ($request) {
                    $query->where('created_at', '<=', $request->from_to);
                })
                ->latest()
                ->paginate($request->datatable_length);

                return response()->json([
                    'status' => 200,
                    'wishlistItems' => $wishlistItems
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function cartItems(Request $request)
    {
        try {
            $cartItems = CartItem::with('productDetail', 'userDetail:id,name,email,mobile')->whereHas('productDetail')
                ->when($request->has('from_date') && $request->filled('from_date'), function ($query) use ($request) {
                    $query->where('created_at', '>=', $request->from_date);
                })
                ->when($request->has('from_to') && $request->filled('from_to'), function ($query) use ($request) {
                    $query->where('created_at', '<=', $request->from_to);
                })
                ->latest()
                ->paginate($request->datatable_length);

                return response()->json([
                    'status' => 200,
                    'cartItems' => $cartItems
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
