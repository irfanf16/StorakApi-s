<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserStore;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\ProductVariant;
use App\Models\Store;
use App\Models\User;
use App\Models\Partner;

class AdminDashboardController extends Controller
{
    /*
    |======================================================================
    | Display The Listing of Statistics For Storak Admin Dashboard
    |======================================================================
    */
    public function index()
    {
        $categories_count = Category::count();
        $subcategories_count = SubCategory::count();
        $childcategories_count = ChildCategory::count();
        $products_count = Product::count();
        $brands_count = Brand::count();
        $attributes_count = Attribute::count();
        $variants_count = ProductVariant::count();
        $stores_count = Store::count();
        $vendors_count = User::where('role_id', 2)->count();
        $buyers_count = User::where('role_id', 3)->count();
        $partners_count = Partner::count();
        $recent_orders = Order::with('user')->latest()
            ->take(10)->get();
        $orders_count=Order::count();
        $recent_products = Product::with('store')->latest()
            ->take(10)->get();
        $recent_stores = Store::with('vendorDetails')->whereHas('vendorDetails')->latest()
            ->take(10)->get();
        $recent_user_stores = UserStore::with('customerDetails')->whereHas('customerDetails')->latest()
            ->take(10)->get();
        $recent_buyers = User::where('role_id', 3)->latest()
            ->take(10)->get();


        return response()->json([
            'status' => 200,
            'categories_count' => $categories_count,
            'subcategories_count' => $subcategories_count,
            'childcategories_count' => $childcategories_count,
            'products_count' => $products_count,
            'brands_count' => $brands_count,
            'attributes_count' => $attributes_count,
            'stores_count' => $stores_count,
            'vendors_count' => $vendors_count,
            'buyers_count' => $buyers_count,
            'partners_count' => $partners_count,
            'recent_orders' => $recent_orders,
            'orders_count' => $orders_count,
            'recent_products' => $recent_products,
            'recent_stores' => $recent_stores,
            'recent_user_stores' => $recent_user_stores,
            'recent_buyers' => $recent_buyers,
            'variants_count' => $variants_count,
        ]);
    }


    /*
    |======================================================================
    | Show the form for creating a new resource.
    |======================================================================
    */
    public function create()
    {
        //
    }


    /*
    |======================================================================
    | Store a newly created resource in storage.
    |======================================================================
    */
    public function store(Request $request)
    {
        //
    }


    /*
    |=====================================================================
    | Display the specified resource.
    |=====================================================================
    */
    public function show($id)
    {
        //
    }


    /*
    |=====================================================================
    | Show the form for editing the specified resource.
    |=====================================================================
    */
    public function edit($id)
    {
        //
    }


    /*
    |=====================================================================
    | Update the specified resource in storage.
    |=====================================================================
    */
    public function update(Request $request, $id)
    {
        //
    }


    /*
    |=====================================================================
    | Remove the specified resource from storage.
    |=====================================================================
    */
    public function destroy($id)
    {
        //
    }


}
