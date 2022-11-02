<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\FiltersAttributeResource;
use App\Http\Resources\FiltersResource;
use App\Http\Resources\MatchingFiltersResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SearchStoreResource;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Fulfillment;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class AppFiltersController extends Controller
{
    /*
    |=========================================================
    | GET LIST OF ALL PRODUCTS WITH SPECIFIC CATEGORY
    |=========================================================
    */
    public function generalFilters(Request $request, $id = null)
    {
        try {
            $categories = Category::with(['subcategories.childcategories'])
                ->where('status', 1)
                ->inRandomOrder()
                ->get();
            $categories = MatchingFiltersResource::collection($categories);
            $brands = Brand::inRandomOrder()->where('status', 1)
                ->get();
            $brands = BrandResource::collection($brands);
            $stores = Store::inRandomOrder()->where('status', 1)
                ->get();
            $stores = SearchStoreResource::collection($stores);
            $fulfillments = Fulfillment::select('id', 'name')->inRandomOrder()->get();
            $colors = Attribute::with('keys')->where('status', 1)->where('id', 1)->inRandomOrder()->get();
            $colors = FiltersAttributeResource::collection($colors);
            return response()->json([
                'status' => 200,
                'filters' => [
                    'categories' => $categories,
                    'brands' => $brands,
                    'stores' => $stores,
                    'fulfillments' => $fulfillments,
                    'colors' => $colors,
                ],
                // 'products'=> $products
            ]);

        } catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }


    /*
    |=========================================================
    | GET LIST OF ALL PRODUCTS WITH SPECIFIC CATEGORY
    |=========================================================
    */
    public function filteredProducts(Request $request)
    {
        try {
            $per_page_products = $request->per_page_products;

            $brands = $request->brands;
            $stores = $request->stores;
            $filter_requests = $request->except('per_page_products', 'currentPage', 'page', 'brands', 'stores', 'min_price', 'max_price');

            $filters = [];
            foreach ($filter_requests as $key => $req) {
                if ($req) {
                    $filters[$key] = $req;
                }
            }


            if (isset($request->min_price)) {
                $min_price = $request->min_price;
            } else {
                $min_price = 0;
            }

            if (isset($request->max_price)) {
                $max_price = $request->max_price;
            } else {
                $max_price = 0;
            }

            // CONDIONAL QUERYING
            $products = Product::select('id', 'name', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating', 'created_at', 'updated_at')
                ->withCount('mostSoldProducts')
                ->withCount('mostWishlistProducts')
                ->where($filters)
                ->where('status', 1);

            if (!empty($brands)) {
                $products = $products->whereIn('brand_id', $brands);
            }
            if (!empty($stores)) {
                $products = $products->whereIn('store_id', $stores);
            }
            if (empty($stores)) {
                $products = $products->whereRelation('store', 'is_verified', '=', 1);
                $products = $products->whereRelation('store', 'status', '=', 1);
            }


            if (isset($request->min_price)) {
                $min_price = $request->min_price;
            } else {
                $min_price = 0;
            }

            if (isset($request->max_price)) {
                $max_price = $request->max_price;
            } else {
                $max_price = 0;
            }


            // filter by price
            if ($max_price > $min_price) {
                $products = $products->with('variants', function ($q) use ($min_price, $max_price) {
                    $q->where([
                        ['special_price', '>=', $min_price],
                        ['special_price', '<=', $max_price]
                    ]);
                })->whereHas('variants', function ($q) use ($min_price, $max_price) {
                    $q->where([
                        ['special_price', '>=', $min_price],
                        ['special_price', '<=', $max_price]
                    ]);

                });
            } else {
                if ($min_price > 0) {
                    $products = $products->with('variants', function ($q) use ($min_price, $max_price) {
                        $q->where([
                            ['special_price', '>=', $min_price],

                        ]);
                    })->whereHas('variants', function ($q) use ($min_price, $max_price) {
                        $q->where([
                            ['special_price', '>=', $min_price],

                        ]);
                    });
                }

            }


            $products = $products->with('category:id,title,slug')
                ->with('brand')
                ->with('firstVariant:id,price,special_price,product_id')
                ->paginate($per_page_products);

            return response()->json([
                'status' => 200,
                'products' => $products,
            ]);

        } catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }

    public function productsByFiltered(Request $request)
    {

        try {
            $per_page_products = $request->perPageProducts;


            if (isset($request->min_price)) {
                $min_price = $request->min_price;
            } else {
                $min_price = 0;
            }

            if (isset($request->max_price)) {
                $max_price = $request->max_price;
            } else {
                $max_price = 0;
            }


            // CONDIONAL QUERYING
            $products = Product::with('category', 'brand', 'firstVariant')
                ->withCount('mostSoldProducts')
                ->withCount('mostWishlistProducts')
                ->where('status', 1)
//                ->select('id', 'name', 'name_ar', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->when($request->has('store_id') && $request->filled('store_id'), function ($query) use ($request) {
                    $query->where('store_id', $request->store_id);
                })
                ->when(empty($request->has('store_id')), function ($query) {
                    $query->whereRelation('store', 'is_verified', '=', 1);
                    $query->whereRelation('store', 'status', '=', 1);
                })
                ->when($request->has('brand_id') && $request->filled('brand_id'), function ($query) use ($request) {
                    $query->where('brand_id', $request->brand_id);
                })
                ->when($request->has('category_id') && $request->filled('category_id'), function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                })
                ->when($request->has('subcategory_id') && $request->filled('subcategory_id'), function ($query) use ($request) {
                    $query->where('subcategory_id', $request->subcategory_id);
                })
                ->when($request->has('childcategory_id') && $request->filled('childcategory_id'), function ($query) use ($request) {
                    $query->where('childcategory_id', $request->childcategory_id);
                })
                ->when($request->has('sort_by') && $request->sort_by == 'latest_product', function ($query) use ($request) {
                    $query->latest();
                })
                ->when($request->has('sort_by') && $request->sort_by == 'min_price', function ($query) use ($request) {
                    $query->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                        ->orderBy('product_variants.special_price', 'ASC');
                })
                ->when($request->has('sort_by') && $request->sort_by == 'max_price', function ($query) use ($request) {
                    $query->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                        ->orderBy('product_variants.special_price', 'DESC');
                })
                ->when($request->has('sort_by') && $request->sort_by == 'most_sold_products', function ($query) use ($request) {
//                    $query->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                    $query->orderBy('most_sold_products_count', 'DESC');
                })
                ->when($request->has('sort_by') && $request->sort_by == 'most_wishlisted_products', function ($query) use ($request) {
//                    $query->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                    $query->orderBy('most_wishlist_products_count', 'DESC');

                })
                ->when($request->has('sort_by') && $request->sort_by == 'most_viewed_products', function ($query) use ($request) {
//                    $query->join('product_variants', 'product_variants.product_id', '=', 'products.id')
                    $query->orderBy('views', 'DESC');

                })
                ->when($max_price > $min_price, function ($query) use ($max_price, $min_price) {
                    $query->with('variants', function ($q) use ($min_price, $max_price) {
                        $q->where([
                            ['special_price', '>=', $min_price],
                            ['special_price', '<=', $max_price]
                        ]);
                    })->whereHas('variants', function ($q) use ($min_price, $max_price) {
                        $q->where([
                            ['special_price', '>=', $min_price],
                            ['special_price', '<=', $max_price]
                        ]);
                    });
                })
                ->paginate($per_page_products);
            $products = ProductResource::collection($products);

            return response()->json([
                'status' => 200,
                'products' => $products->response()->getData(),
            ]);

        } catch (\Throwable $th) {

//            throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }

}

