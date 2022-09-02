<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CollectionsResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SearchChildCategoryResource;
use App\Http\Resources\SearchMyStoreResource;
use App\Http\Resources\SearchStoreResource;
use App\Http\Resources\SearchSubCategoryResource;
use App\Http\Resources\SubCategoryResource;

//use App\Http\Resources\SubCategorySearchResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Store;
use App\Models\SubCategory;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
    public static function index($key, Request $request)
    {
        // phpinfo();


        $categories = Category::select('id', 'title', 'title_ar', 'slug', 'logo_image', 'banner_image', 'mobile_image')
            ->where('title', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();
        $subcategories = SubCategory::with('category:id,slug')
            ->select('id', 'title', 'title_ar', 'slug', 'image', 'category_id')
            ->where('title', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();

        $childcategories = ChildCategory::with('category:id,slug')
            ->with('subcategory:id,slug')
            ->select('id', 'title', 'title_ar', 'slug', 'image', 'category_id', 'subcategory_id')
            ->where('title', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();
        $brands = Brand::where('name', 'like', '%' . $key . '%')
            ->select('id', 'name', 'name_ar', 'slug', 'description', 'logo_image', 'cover_image')
            ->where('status',1)
            ->get();
        $stores = Store::where('store_name', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();
        $my_stores = UserStore::where('name', 'like', '%' . $key . '%')
            ->select('id', 'name', 'name_ar', 'slug', 'profile', 'cover', 'visibility', 'code', 'views', 'likes', 'shares', 'follows')
            ->withCount('collections')
            ->where('status',1)
            ->get();
        $collections = Collection::where('name', 'like', '%' . $key . '%')
            ->select('id', 'name', 'name_ar', 'slug', 'code')
            ->get();

        $products = Product::with('firstVariant:id,price,special_price,product_id')
            ->with('brand:id,name,name_ar,slug,logo_image,cover_image,featured')
            ->with('category:id,slug,title,title_ar')
            ->where('status',1)
            ->whereRelation('store','is_verified','=',1)
            ->whereRelation('store','status','=',1)
            ->where('name', 'like', '%' . $key . '%')
            ->orwhere('short_description', 'like', '%' . $key . '%')
            ->orwhere('tags', 'like', '%' . $key . '%')
            ->orwhere('specifications', 'like', '%' . $key . '%')
            ->orwhere('keywords', 'like', '%' . $key . '%')
            ->select('id', 'name', 'name_ar', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating', 'created_at', 'updated_at')
            ->withCount('mostSoldProducts')
            ->withCount('mostWishlistProducts')
            ->get();


        $categories = CategoryResource::collection($categories);
        $subcategories = SearchSubCategoryResource::collection($subcategories);
        $childcategories = SearchChildCategoryResource::collection($childcategories);
        $brands = BrandResource::collection($brands);
        $stores = SearchStoreResource::collection($stores);
        $my_stores = SearchMyStoreResource::collection($my_stores);
        $collections = CollectionsResource::collection($collections);
        $products = ProductResource::collection($products);



        $products =  Arr::flatten($products,0);
        $categories =  Arr::flatten($categories,0);
        $subcategories =  Arr::flatten($subcategories,0);
        $childcategories =  Arr::flatten($childcategories,0);
        $stores =  Arr::flatten($stores,0);
        $my_stores =  Arr::flatten($my_stores,0);
        $brands =  Arr::flatten($brands,0);
        $collections =  Arr::flatten($collections,0);
        $suggestions = array_merge($products,$categories,$subcategories,$childcategories,$stores,$my_stores,$brands,$collections);
        return response()->json([
            'suggestions' =>$suggestions,
            'products' => $products,
            'categories' => $categories,
            'sub_categories' => $subcategories,
            'child_categories' => $childcategories,
            'stores' => $stores,
            'brands' => $brands,
            'my_stores' => $my_stores,
            'collections' => $collections
        ]);

    }
    public static function search(Request $request)
    {

        $key=$request->keyword;


        $categories = Category::select('id', 'title', 'title_ar', 'slug', 'logo_image', 'banner_image', 'mobile_image')
            ->where('title', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();
        $subcategories = SubCategory::with('category:id,slug')
            ->select('id', 'title', 'title_ar', 'slug', 'image', 'category_id')
            ->where('title', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();

        $childcategories = ChildCategory::with('category:id,slug')
            ->with('subcategory:id,slug')
            ->select('id', 'title', 'title_ar', 'slug', 'image', 'category_id', 'subcategory_id')
            ->where('title', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();
        $brands = Brand::where('name', 'like', '%' . $key . '%')
            ->select('id', 'name', 'name_ar', 'slug', 'description', 'logo_image', 'cover_image')
            ->where('status',1)
            ->get();
        $stores = Store::where('store_name', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();
        $my_stores = UserStore::where('name', 'like', '%' . $key . '%')
            ->select('id', 'name', 'name_ar', 'slug', 'profile', 'cover', 'visibility', 'code', 'views', 'likes', 'shares', 'follows')
            ->where('status',1)
            ->withCount('collections')
            ->get();
        $collections = Collection::where('name', 'like', '%' . $key . '%')
            ->select('id', 'name', 'name_ar', 'slug', 'code')
            ->get();

        $products = Product::with('firstVariant:id,price,special_price,product_id')
            ->with('brand:id,name,name_ar,slug,logo_image,cover_image,featured')
            ->with('category:id,slug,title,title_ar')
            ->where('status',1)
            ->whereRelation('store','is_verified','=',1)
            ->whereRelation('store','status','=',1)
            ->where('name', 'like', '%' . $key . '%')
//            ->orwhere('short_description', 'like', '%' . $key . '%')
//            ->orwhere('tags', 'like', '%' . $key . '%')
//            ->orwhere('specifications', 'like', '%' . $key . '%')
//            ->orwhere('keywords', 'like', '%' . $key . '%')
            ->select('id', 'name', 'name_ar', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating', 'created_at', 'updated_at')
            ->withCount('mostSoldProducts')
            ->withCount('mostWishlistProducts')
            ->get();



        $categories = CategoryResource::collection($categories);
        $subcategories = SearchSubCategoryResource::collection($subcategories);
        $childcategories = SearchChildCategoryResource::collection($childcategories);
        $brands = BrandResource::collection($brands);
        $stores = SearchStoreResource::collection($stores);
        $my_stores = SearchMyStoreResource::collection($my_stores);
        $collections = CollectionsResource::collection($collections);
        $products = ProductResource::collection($products);



        $products =  Arr::flatten($products,0);
        $categories =  Arr::flatten($categories,0);
        $subcategories =  Arr::flatten($subcategories,0);
        $childcategories =  Arr::flatten($childcategories,0);
        $stores =  Arr::flatten($stores,0);
        $my_stores =  Arr::flatten($my_stores,0);
        $brands =  Arr::flatten($brands,0);
        $collections =  Arr::flatten($collections,0);
        $suggestions = array_merge($products,$categories,$subcategories,$childcategories,$stores,$my_stores,$brands,$collections);
        return response()->json([
            'suggestions' =>$suggestions,
            'products' => $products,
            'categories' => $categories,
            'sub_categories' => $subcategories,
            'child_categories' => $childcategories,
            'stores' => $stores,
            'brands' => $brands,
            'my_stores' => $my_stores,
            'collections' => $collections
        ]);

    }

    public function refine($type, $key)
    {
        if ($type == 'direct') {
            $result = self::direct($key);

        } else {

            return response()->json([
                'status' => 404,
                'message' => 'Unable to search'

            ]);
        }


        return response()->json([
            'status' => 200,
            'products' => $result,

        ]);

    }

    public static function direct($key)
    {
        $filter_found = self::getFilters($key);

        $allFilter = $filter_found['filters'];


        $allproducts = array();

        foreach ($allFilter as $key => $value) {
            $products = Product::select('id', 'slug', 'brand_id', 'category_id', 'subcategory_id', 'childcategory_id', 'store_id')
                ->where($key, $value)->where('status',1)->get();
            // array_push($allproducts , $products);
            $allproducts[$key] = $products;
        }

        $allproducts = Arr::flatten($allproducts);
        $allproducts = array_unique(array_column($allproducts, 'id'));

        // dd($allproducts);

        $products = Product::select('id', 'name', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
            ->whereIn('id', $allproducts)
            ->where('status',1)
            ->whereRelation('store','is_verified','=',1)
            ->whereRelation('store','status','=',1)
            ->with('brand')
            ->with('firstVariant:id,price,special_price,product_id')
            ->paginate(10);


        $result = $products;

        // dd($result);

        return $result;

    }

    public static function getFilters($key)
    {
        $categories = Category::
        select('id', 'title', 'slug')
            ->where('title', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();

        $subcategories = SubCategory::
        select('id', 'title', 'slug')
            ->where('title', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();

        $childcategories = ChildCategory::
        select('id', 'title', 'slug')
            ->where('title', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();

        $brands = Brand::
        where('name', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();

        $stores = Store::
        where('store_name', 'like', '%' . $key . '%')
            ->where('status',1)
            ->get();

        $products = Product::
        where('name', 'like', '%' . $key . '%')
            ->where('status',1)
            ->select('id', 'name')
            ->get();


        $filters = [];

        $found_data = json_decode(json_encode([
            'id' => $products,
            'category_id' => $categories,
            'subcategory_id' => $subcategories,
            'childcategory_id' => $childcategories,
            'store_id' => $stores,
            'brand_id' => $brands
        ]));

        foreach ($found_data as $key => $value) {
            // dd($key , $value);
            if (count($value) > 0) {

                $ids = array_column($value, 'id');

                $filters[$key] = $ids;

            }
            // else{
            //     $filters[$key] = [];
            // }

        }


        return [
            // 'products'          => $products,
            // 'categories'        => $categories,
            // 'sub_categories'    => $subcategories,
            // 'child_categories'  => $childcategories,
            // 'stores'            => $stores,
            // 'brands'            => $brands,
            'filters' => $filters
        ];
    }


    public function refineb($type, $key)
    {

        if ($type == "products") {
            $response = Product::select('id', 'name', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->with('brand')
                ->with('firstVariant:id,price,special_price,product_id')
                ->where('name', 'like', '%' . $key . '%')
                ->where('status',1)
                ->whereRelation('store','is_verified','=',1)
                ->whereRelation('store','status','=',1)
                ->paginate(10);
        } elseif ($type == "categories") {

            $response = Category::where('title', 'like', '%' . $key . '%')->where('status',1)->paginate(10);
        } elseif ($type == "sub_categories") {

            $response = SubCategory::where('title', 'like', '%' . $key . '%')->where('status',1)->paginate(10);
        } elseif ($type == "child_categories") {

            $response = ChildCategory::where('title', 'like', '%' . $key . '%')->where('status',1)->paginate(10);
        } elseif ($type == "brands") {

            $response = Brand::
            where('name', 'like', '%' . $key . '%')->where('status',1)
                ->paginate(10);
        } elseif ($type == "stores") {

            $response = Store::where('id', $key)->where('status',1)->paginate(10);
        } elseif ($type == 'direct') {

        } else {

            return response()->json([
                'status' => 404,
                'message' => 'Unable to search'

            ]);
        }


        return response()->json([
            'status' => 200,
            'response' => $response,

        ]);

    }


}
