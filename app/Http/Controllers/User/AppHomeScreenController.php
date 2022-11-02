<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\FeatureCategoryResource;
use App\Http\Resources\FeaturedSellersResource;
use App\Http\Resources\FeaturedUserStoreResource;
use App\Http\Resources\HomeScreenResource;
use App\Http\Resources\ProductResource;
use App\Models\AppSetting;
use App\Models\Brand;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\MobileCover;
use App\Models\Product;
use App\Models\Store;
use App\Models\UserStore;

class AppHomeScreenController extends Controller
{
    /*
    |=======================================================================
    | Get Listing of Mobile App Home Screen All Sections
    |=======================================================================
    */
    public function index()
    {
        try {
            $covers = MobileCover::where('status', 1)
                ->select('id', 'image')
                ->inRandomOrder()
                ->get();

            $categories = Category::where('status', 1)
                ->select('id', 'title', 'title_ar', 'slug', 'logo_image', 'mobile_image')
                ->take(8)
                ->inRandomOrder()
                ->get();
            $categories = CategoryResource::collection($categories);
            $recommended_products = Product::with('firstVariant')
                ->with('brand:id,name,name_ar,slug')
                ->whereHas('firstVariant',function ($query){
                    $query->where('quantity','>=',1)->where('availability',1);
                })
                ->whereRelation('store', 'is_verified', '=', 1)->whereRelation('store', 'status', '=', 1)
                ->where('status', 1)
                ->select('id', 'name', 'name_ar', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->take(20)
                ->inRandomOrder()
                ->get();
            $recommended_products = ProductResource::collection($recommended_products);
            $sod_products = Product::with('firstVariant')
                ->with('brand:id,name,name_ar,slug')
                ->whereHas('firstVariant',function ($query){
                    $query->where('quantity','>=',1)->where('availability',1);
                })
                ->select('id', 'name', 'name_ar', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->where([
                    'status' => 1,
                ])
                ->whereRelation('store', 'is_verified', '=', 1)->whereRelation('store', 'status', '=', 1)
                ->inRandomOrder()
                ->take(6)
                ->get();
            $sod_products = ProductResource::collection($sod_products);
            $featured_products = Product::with('firstVariant')
                ->with('brand:id,name,name_ar,slug')
                ->whereHas('firstVariant',function ($query){
                    $query->where('quantity','>=',1)->where('availability',1);
                })
                ->select('id', 'name', 'name_ar', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->where([
                    'status' => 1,
                    'featured' => 1
                ])
                ->whereRelation('store', 'is_verified', '=', 1)->whereRelation('store', 'status', '=', 1)
                ->inRandomOrder()
                ->take(20)
                ->get();
            $featured_products = ProductResource::collection($featured_products);

            $mega_deals = Product::with('firstVariant')
                ->with('brand:id,name,name_ar,slug')
                ->whereHas('firstVariant',function ($query){
                    $query->where('quantity','>=',1)->where('availability',1);
                })
                ->where('status', 1)
                ->whereRelation('store', 'is_verified', '=', 1)->whereRelation('store', 'status', '=', 1)
                ->select('id', 'name', 'name_ar', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->take(7)
                ->inRandomOrder()
                ->get();
            $mega_deals = ProductResource::collection($mega_deals);

            $top_selling_products = Product::with('firstVariant')
                ->with('brand:id,name,name_ar,slug')
                ->whereHas('firstVariant',function ($query){
                    $query->where('quantity','>=',1)->where('availability',1);
                })
                ->where('status', 1)
                ->whereRelation('store', 'is_verified', '=', 1)->whereRelation('store', 'status', '=', 1)
                ->select('id', 'name', 'name_ar', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->take(7)
                ->inRandomOrder()
                ->get();
            $top_selling_products = ProductResource::collection($top_selling_products);

            $featured_sellers = Store::with('user:id,name,status')
                ->whereRelation('user', 'status', '=', 1)
                ->where('featured', 1)
                ->inRandomOrder()
                ->take(10)
                ->get();
            $featured_sellers = FeaturedSellersResource::collection($featured_sellers);
            $user_stores = UserStore::where([
                'status' => true,
                'featured' => true,
            ])
                ->withCount('collections')
                ->inRandomOrder()
                ->with([
                    'collections',
                    'likers:id,name,profile_image',
                    'followers:id,name,profile_image'
                ])
                ->get();
            $user_stores = FeaturedUserStoreResource::collection($user_stores);
            $brands = Brand::select('id', 'name', 'name_ar', 'logo_image', 'slug')
                ->limit(12)
                ->where('status', 1)
                ->inRandomOrder()
                ->get();
            $brands = BrandResource::collection($brands);
            $women_category = Category::where('title', '=', 'Women Store')->where('status', 1)
                ->with('brands', function ($query) {
                    $query->inRandomOrder()->where('status', 1)->limit(6);
                })
                ->with('subcategories', function ($query) {
                    $query->with('childcategories', function ($query) {
                        $query->where('status', 1)->limit(6);
                    })->limit(2);
                })
                ->select('id', 'title', 'title_ar', 'banner_image')
                ->first();
            $man_category = Category::where('title', '=', 'Men Store')->where('status', 1)
                ->with('brands', function ($query) {
                    $query->inRandomOrder()->where('status', 1)->limit(6);
                })
                ->with('subcategories', function ($query) {
                    $query->with('childcategories', function ($query) {
                        $query->where('status', 1)->limit(6);
                    })->limit(2);
                })
                ->select('id', 'title', 'title_ar', 'slug', 'banner_image')
                ->first();
            $kids_store = Category::where('title', '=', 'Kids Store')->where('status', 1)
                ->with('brands', function ($query) {
                    $query->inRandomOrder()->where('status', 1)->limit(6);
                })
                ->with('subcategories', function ($query) {
                    $query->with('childcategories', function ($query) {
                        $query->inRandomOrder()->where('status', 1)->limit(6);
                    })->inRandomOrder()->where('status', 1)->limit(2);
                })
                ->select('id', 'title', 'title_ar', 'slug', 'banner_image')
                ->first();

            $shop_by_category = [
                'men_store' => HomeScreenResource::make($man_category),
                'women_store' => HomeScreenResource::make($women_category),
                'kids_store' => HomeScreenResource::make($kids_store),
            ];

            $appSetting = AppSetting::where('shortcode', 'home')->select('id', 'value1', 'value2')->get();

            return response()->json([
                'status' => 200,
                'appSetting' => $appSetting,
                'covers' => $covers,
                'categories' => $categories,
                'recommended_products' => $recommended_products,
                'sod_products' => $sod_products,
                'featured_products' => $featured_products,
                'mega_deals' => $mega_deals,
                'top_selling_products' => $top_selling_products,
                'featured_sellers' => $featured_sellers,
                'recommended_stores' => $user_stores,
                'brands' => $brands,
                'shop_by_category' => $shop_by_category,
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
    |=============================================================================
    | Get List of All Active Categories with Subcategories
    |=============================================================================
    */
    public function categoriesWithSubcategories()
    {
        try {
            $categories = Category::with('subcategories')
                ->where('status', 1)
                ->orderBy('order', 'asc')
                ->select('id', 'title', 'title_ar', 'slug', 'mobile_image')
                ->inRandomOrder()
                ->with(['subcategories' => function ($query) {
                    $query->withCount('products');
                }])
                ->withCount('products')
                ->get();

            $categories = FeatureCategoryResource::collection($categories);
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
    |=============================================================================
    | Get List of All Active Categories with Subcategories
    |=============================================================================
    */
    public function topSellingProducts()
    {
        try {
            $top_selling_products = Product::with('firstVariant:id,price,special_price,product_id')
                ->with('brand:id,name,slug')
                ->where('status', 1)
                ->whereRelation('store', 'is_verified', '=', 1)->whereRelation('store', 'status', '=', 1)
                ->select('id', 'name', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
//                ->orderBy('id', 'desc')
                ->inRandomOrder()
                ->paginate(14);

            // dd($categories->toArray());

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

    public function mostSellingProducts()
    {
        try {
            $top_selling_products = Product::with('firstVariant:id,price,special_price,product_id')
                ->with('category')
                ->with('brand:id,name,slug,name_ar')
                ->where('status', 1)
                ->whereRelation('store', 'is_verified', '=', 1)->whereRelation('store', 'status', '=', 1)
                ->select('id', 'name', 'name_ar', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->paginate(14);
            $top_selling_products = ProductResource::collection($top_selling_products);
            return response()->json([
                'status' => 200,
                'top_selling_products' => $top_selling_products->response()->getData(),
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

    public function brands(Request $request)
    {
        try {

            $brands = Brand::where('status', 1)->paginate(10);
//            $brands = BrandResource::collection($brands);
            return response()->json([
                'status' => 200,
                'brands' => $brands,
//                'brands' => $brands->response()->getData(),
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


}
