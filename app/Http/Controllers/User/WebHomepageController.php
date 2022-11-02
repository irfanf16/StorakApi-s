<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\FeaturedSellersResource;
use App\Http\Resources\FeaturedSllersResource;
use App\Http\Resources\FeaturedUserStoreResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

use App\Models\WebsiteBanner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Store;
use App\Models\UserStore;

class WebHomepageController extends Controller
{
    /*
    |============================================================
    | GET LISTING OF ALL ACTIVE HOMEPAGE BANNERS
    |============================================================
    */
    public function topBanners()
    {
        try {
            $banners = WebsiteBanner::where('status', 1)
//                ->orderBy('order', 'asc')
                ->inRandomOrder()
                ->get();

            return response()->json([
                'status' => 200,
                'banners' => $banners,
            ]);

        } catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }


    /*
    |============================================================
    | GET LIST OF ACTIVE MAIN-CATEGORIES ONLY
    |============================================================
    */
    public function categoriesOnly()
    {
        try {
            $categories = Category::where('status', 1)
                ->select('id', 'title','title_ar', 'slug','logo_image', 'mobile_image')
                ->inRandomOrder()
                ->get();
            $categories=CategoryResource::collection($categories);
            return response()->json([
                'status' => 200,
                'categories' => $categories,
            ]);

        } catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }


    /*
    |============================================================
    | Get Listing of Recommended Products -- 20 Products
    |============================================================
    */
    public function recommendedProducts()
    {
        try {
            $recommended_products = Product::with('firstVariant')
                ->with('brand:id,name,name_ar,slug,logo_image,cover_image')
                ->with('category')
                ->whereHas('firstVariant',function ($query){
                    $query->where('quantity','>=',1)->where('availability',1);
                })
                ->where('status', 1)
                ->whereRelation('store','is_verified','=',1)
                ->whereRelation('store','status','=',1)
                ->select('id', 'name','name_ar','slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->take(20)
                ->inRandomOrder()
                ->get();

            $recommended_products=ProductResource::collection($recommended_products);
            return response()->json([
                'status' => 200,
                'recommended_products' => $recommended_products,
            ]);

        } catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }


    /*
    |==============================================================
    | Get Listing of Sale of The Day Products -- 6 Products
    |==============================================================
    */
    public function sodProducts()
    {
        try {
            $sod_products = Product::with('firstVariant:id,price,special_price,product_id')
                ->with('brand:id,name,slug,name_ar')
                ->with('category')
                ->where('status', 1)
                ->whereRelation('store','is_verified','=',1)
                ->whereRelation('store','status','=',1)
                ->select('id', 'name','name_ar','slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->take(6)
                ->inRandomOrder()
                ->get();
            $sod_products=ProductResource::collection($sod_products);

            return response()->json([
                'status' => 200,
                'sod_products' => $sod_products,
            ]);

        } catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }


    /*
    |=============================================================
    | Get Listing of Featured Products -- 20 Products
    |==============================================================
    */
    public function featuredProducts()
    {
        try {
            $featured_products = Product::with('firstVariant')
                ->with('brand:id,name,name_ar,slug')
                ->with('category')
                ->whereHas('firstVariant',function ($query){
                    $query->where('quantity','>=',1)->where('availability',1);
                })
                ->where(['status' => 1, 'featured' => 1])
                ->whereRelation('store','is_verified','=',1)
                ->whereRelation('store','status','=',1)
                ->select('id', 'name', 'name_ar','slug','primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->take(20)
                ->inRandomOrder()
                ->get();
            $featured_products=ProductResource::collection($featured_products);

            return response()->json([
                'status' => 200,
                'featured_products' => $featured_products,
            ]);
        } catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }


    /*
    |==============================================================
    | Get Listing of Mega Deal Products -- 7 Products
    |==============================================================
    */
    public function megaDealsProducts()
    {
        try {
            $mega_deals = Product::with('firstVariant:id,price,price,product_id')
                ->with('brand:id,name,name_ar,slug')
                ->with('category')
                ->where('status', 1)
                ->whereRelation('store','is_verified','=',1)
                ->whereRelation('store','status','=',1)
                ->select('id', 'name','name_ar', 'slug','primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->take(7)
                ->inRandomOrder()
                ->get();
            $mega_deals=ProductResource::collection($mega_deals);

            return response()->json([
                'status' => 200,
                'mega_deals' => $mega_deals,
            ]);
        } catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }


    /*
    |==============================================================
    | Get Listing of Top Selling Products -- 100 Products
    |==============================================================
    */
    public function topSellingProducts()
    {
        try {
            $top_selling_products = Product::with('firstVariant:id,price,special_price,product_id')
                ->with('brand:id,name,name_ar,slug')
                ->with('category')
                ->where('status', 1)
                ->whereRelation('store','is_verified','=',1)
                ->whereRelation('store','status','=',1)
                ->select('id', 'name', 'name_ar','slug','primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->take('100')
                ->inRandomOrder()
                ->get();
            $top_selling_products=ProductResource::collection($top_selling_products);

            return response()->json([
                'status' => 200,
                'top_selling_products' => $top_selling_products,
            ]);

        } catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }


    /*
    |================================================================
    | Get Listing of Featured Sellers
    |================================================================
    */
    public function featuredSellers()
    {
        try {
            $featured_sellers = Store::with('user:id,name,status')
                ->whereRelation('user','status','=',1)
                ->where('featured',1)
                ->where('status',1)
                ->take(10)
                ->inRandomOrder()
                ->get();
            $featured_sellers=FeaturedSellersResource::collection($featured_sellers);
            return response()->json([
                'status' => 200,
                'featured_sellers' => $featured_sellers,
            ]);
        } catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }


    /*
    |================================================================
    | Get List of All Active Partners
    |================================================================
    */
    public function activePartners()
    {
        try {
            $partners = Partner::where('status', 1)
                ->select('id', 'image')
                ->inRandomOrder()
                ->get();

            // dd($categories->toArray());
            return response()->json([
                'status' => 200,
                'partners' => $partners,
            ]);

        } catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }

    }


    /*
    |=================================================================
    | Get Listing of Featured User-Stores -- Featured Stores
    |=================================================================
    */
    public function featuredUserStores()
    {
        try {
            $user_stores = UserStore::where([
                'status' => true,
                'featured' => true,
            ])
                ->withCount('collections')
                ->with([
                    'collections',
                    'likers:id,name,profile_image',
                    'followers:id,name,profile_image'
                ])
                ->inRandomOrder()
                ->get();
            $user_stores=FeaturedUserStoreResource::collection($user_stores);
            return response()->json([
                'status' => 200,
                'user_stores' => $user_stores
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "errors" => $e->getMessage()
            ]);
        }

    }


}
