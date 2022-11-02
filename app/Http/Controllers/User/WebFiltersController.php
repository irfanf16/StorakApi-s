<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\FilterProductResource;
use App\Http\Resources\FiltersAttributeResource;
use App\Http\Resources\FiltersResource;
use App\Http\Resources\MatchingFiltersResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SearchStoreResource;
use App\Traits\ApiDataGenerate;
use Illuminate\Http\Request;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Fulfillment;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Store;
use Illuminate\Support\Facades\DB;


class WebFiltersController extends Controller
{
    use ApiDataGenerate;

    /*
    |=============================================================
    | GET LIST OF ALL ACTIVE PRODUCTS -- USING MULTIPLE FILTERS
    |=============================================================
    */
    public function generalFilters(Request $request)
    {
        try {
            $requested_brands = $request->brands;

            $categories = Category::with(['subcategories.childcategories'])
                ->inRandomOrder()
                ->where('status',1)
                ->get();
            $categories=MatchingFiltersResource::collection($categories);
            $brands = Brand::inRandomOrder()->where('status',1)->get();
            $brands=BrandResource::collection($brands);
            $stores = Store::inRandomOrder()->where('status',1)->get();
            $stores=SearchStoreResource::collection($stores);
            $fulfillments = Fulfillment::select('id', 'name')->inRandomOrder()->get();
            $colors = Attribute::with('keys')->where('id', 1)->inRandomOrder()->get();
            $colors=FiltersAttributeResource::collection($colors);
            return response()->json([
                'status' => 200,
                'categories' => $categories,
                'brands' => $brands,
                'stores' => $stores,
                'fulfillments' => $fulfillments,
                'colors' => $colors,
                'req_brands' => $requested_brands,
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
    |=============================================================
    | GET LIST OF ALL ACTIVE PRODUCTS -- USING MULTIPLE FILTERS
    |=============================================================
    */
    public function filteredProducts(Request $request, $id)
    {
//         return response()->json(['response'=>$request->all()]);
        try {
            $per_page_products = $request->perPageProducts;

            $brands = $request->brands;
            $stores = $request->stores;
            $filter_requests = $request->except('perPageProducts', 'currentPage', 'page', 'brands', 'stores', 'min_price', 'max_price');

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
            $products = Product::select('id', 'name', 'slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->where($filters)->where('status',1)->orderBy('created_at', 'desc');


            if (!empty($brands)) {
                $products = $products->whereIn('brand_id', $brands);
            }
            if (!empty($stores)) {
                $products = $products->whereIn('store_id', $stores);
            } if (empty($stores)) {
                $products = $products->whereRelation('store','is_verified','=',1);
                $products = $products->whereRelation('store','status','=',1);
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
                // else{

                //     return response()->json([
                //         'status'   => 100,
                //         'message' => "Starting price can not be greater then Ending price",
                //     ]);
                // }
            }


            // return response()->json($products->get());
            // $product_ids = $products->pluck('id');

            // $products = Product::whereIn('id' , $product_ids)->with('category:id,title')
            //                     ->with('brand')
            //                     ->with('firstVariant:id,price,special_price,product_id' )
            //                     ->paginate($per_page_products);

            $products = $products->with('category:id,title,slug')
                ->with('brand')
                ->with('firstVariant:id,price,special_price,product_id')
                ->paginate($per_page_products);


            // matching filters
            $matching_filters = [

            ];

            if ($request->category_id) {
                $category = Category::where('id', $request->category_id)->where('status',1)->with('subcategories.childcategories.brands', 'stores')->first();
                // array_push($filters , $category);
                $matching_filters['category'] = $category;

                // solo subcat
                $subcategories = $category->subcategories;

                // brands
                $brands = $subcategories->pluck('brands');
                $brands = $brands->flatten();
                $matching_filters['brands'] = $brands;


            } else {
                $category = Category::with('subcategories.childcategories', 'brands', 'stores')->where('status',1)->get();
                $matching_filters['category'] = $category;
                $brands = Brand::select('id', 'name')->where('status',1)->get();
                $matching_filters['brands'] = $brands;
            }

            if ($request->subcategory_id) {
                $subcategory = SubCategory::where('id', $request->subcategory_id)->where('status',1)->with('category', 'childcategories', 'brands')->first();
                $category = $subcategory->category->toArray();

                // empty matching_filters
                $matching_filters = [];
                // cat
                $matching_filters['category'] = $category;

                // subcat
                $matching_filters['category']['subcategories'] = [];
                array_push($matching_filters['category']['subcategories'], $subcategory);

                // brands
                $brands = $subcategory->brands;

                $matching_filters['brands'] = $brands;

            }

            if ($request->childcategory_id) {
                $childcategory = ChildCategory::where('id', $request->childcategory_id)->where('status',1)->with('category', 'subcategory', 'brands')->first();
                $category = $childcategory->category->toArray();
                $subcategory = $childcategory->subcategory->toArray();

                // empty matching_filters
                $matching_filters = [];

                // cat
                $matching_filters['category'] = $category;

                // subcat
                $matching_filters['category']['subcategories'] = [];
                array_push($matching_filters['category']['subcategories'], $subcategory);

                // childcat
                $matching_filters['category']['subcategories'][0]['childcategories'] = [];
                array_push($matching_filters['category']['subcategories'][0]['childcategories'], $childcategory);

                // brands
                $brands = $childcategory->brands;
                $matching_filters['brands'] = $brands;


            }


            // if($request->childcategory_id){
            //     $childcategory = ChildCategory::where('id' , $request->childcategory_id)->with('brands')->first();
            //     // array_push($filters , $childcategory);
            //     $matching_filters['childcategory'] = $childcategory;

            // }


            // applied filters
            $filters = [

            ];

            if ($request->category_id) {
                $category = Category::where('id', $request->category_id)->first();
                array_push($filters, $category);
            }

            if ($request->subcategory_id) {
                $subcategory = SubCategory::where('id', $request->subcategory_id)->first();
                array_push($filters, $subcategory);

            }

            if ($request->childcategory_id) {
                $childcategory = ChildCategory::where('id', $request->childcategory_id)->first();
                array_push($filters, $childcategory);

            }

            if ($request->brands) {
                $brands = Brand::whereIn('id', $request->brands)->get();
                foreach ($brands as $brand) {

                    array_push($filters, $brand);
                }

            }

            if ($request->stores) {
                $stores = Store::whereIn('id', $request->stores)->get();
                foreach ($stores as $store) {

                    array_push($filters, $store);
                }

            }


            return response()->json([
                'status' => 200,
                'products' => $products,
                'filters' => $filters,
                'matching_filters' => $matching_filters
            ]);

        } catch (\Throwable $th) {


            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }
    }

    /*
    |=============================================================
    | GET LIST OF ALL ACTIVE PRODUCTS -- USING MULTIPLE FILTERS
    |=============================================================
    */
    public function filteredProductsSlug(Request $request)
    {

//        dd($request->header('lang'));
//          return response()->json($request->all());
//        try {
            $per_page_products = $request->perPageProducts;

//            $brands = $request->brands;
//            dd($brands);
            $brands = [];
            if ($request->brands) {
                foreach ($request->brands as $brand) {
                    $data = Brand::where('slug', $brand)->first();
                    if ($data) {
                        $brands[] = $data->id;
                    }

                }
            }


//            $stores = $request->stores;
            $stores = [];
            if ($request->stores) {
                foreach ($request->stores as $store) {
                    $data = Store::where('slug', $store)->first();
                    if ($data) {
                        $stores[] = $data->id;
                    }

                }
            }
            $filter_requests = $request->except('perPageProducts', 'currentPage', 'page', 'brands', 'stores', 'min_price', 'max_price');

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
            $products = Product::with('category')
                ->with('brand')
                ->with('firstVariant')
                ->where('status',1)
                ->select('id', 'name', 'name_ar','slug', 'primary_image', 'brand_id', 'likes', 'views', 'sales', 'reports', 'total_reviews', 'avg_rating')
                ->when($request->has('category_id') && $request->filled('category_id'), function ($query) use ($request) {
                    $query->where('category_id', Category::where('slug', $request->category_id)->first()->id);
                })
                ->when($request->has('subcategory_id') && $request->filled('subcategory_id'), function ($query) use ($request) {
                    $query->where('subcategory_id', SubCategory::where('slug', $request->subcategory_id)->first()->id);
                })
                ->when($request->has('childcategory_id') && $request->filled('childcategory_id'), function ($query) use ($request) {
                    $query->where('childcategory_id', ChildCategory::where('slug', $request->childcategory_id)->first()->id);
                })
                ->when($max_price > $min_price, function ($query) use ($min_price, $max_price) {
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
                ->when($min_price > 0, function ($query) use ($min_price, $max_price) {
                    $query->with('variants', function ($q) use ($min_price, $max_price) {
                        $q->where([
                            ['special_price', '>=', $min_price],
                        ]);
                    })->whereHas('variants', function ($q) use ($min_price, $max_price) {
                        $q->where([
                            ['special_price', '>=', $min_price],
                        ]);
                    });
                })
                ->when(!empty($brands), function ($query) use ($brands) {
                    $query->whereIn('brand_id', $brands);
                })->when(!empty($stores), function ($query) use ($stores) {
                    $query->whereIn('store_id', $stores);
                })->when(empty($stores), function ($query) use ($stores) {
                    $query->whereRelation('store','is_verified','=',1);
                    $query->whereRelation('store','status','=',1);
                })
                ->orderBy('created_at', 'desc')
                ->withCount('mostSoldProducts')
                ->withCount('mostWishlistProducts')
                ->paginate($per_page_products);

            $products = ProductResource::collection($products);

            // matching filters
            $matching_filters = [];


            if ($request->stores) {

                if ($request->childcategory_id){
                    $childcategory = ChildCategory::where('slug', $request->childcategory_id)->where('status',1)
                        ->with(['category'=>function($query){
                            $query->withCount('products');
                        }, 'subcategory'=>function($query){
                            $query->withCount('products');

                        }])

                        ->first();
                    $category = $childcategory->category->toArray();
                    $subcategory = $childcategory->subcategory->toArray();

                    // empty matching_filters
                    $matching_filters = [];

                    // cat
                    $matching_filters['category'] = $category;

                    // subcat
                    $matching_filters['category']['subcategories'] = [];
                    array_push($matching_filters['category']['subcategories'], $subcategory);

                    // childcat
                    $matching_filters['category']['subcategories'][0]['childcategories'] = [];
                    array_push($matching_filters['category']['subcategories'][0]['childcategories'], $childcategory);
                    $matching_filters['category']=MatchingFiltersResource::make($matching_filters['category']);
//                $brands = $childcategory->brands;

                    $brands_id = DB::table('products')->where('childcategory_id', $childcategory->id)->distinct()->pluck('brand_id');
                    $brands = Brand::whereIn('id', $brands_id)->select('id', 'name','name_ar','slug')->where('status',1)->get();
                    $matching_filters['brands'] = BrandResource::collection($brands);

                }elseif ($request->subcategory_id) {

                    $subcategory = SubCategory::where('slug', $request->subcategory_id)->where('status',1)
                        ->with(['category'=>function($query){
                            $query->withCount('products');
                        }, 'childcategories'=>function($query){
                            $query->withCount('products');

                        }])
                        ->first();
                    $category = $subcategory->category->toArray();

                    // empty matching_filters
                    $matching_filters = [];
                    // cat
                    $matching_filters['category'] = $category;

                    // subcat
                    $matching_filters['category']['subcategories'] = [];
                    array_push($matching_filters['category']['subcategories'], $subcategory);
                    $matching_filters['category']=MatchingFiltersResource::make($matching_filters['category']);

                    // brands
//                $brands = $subcategory->brands;

                    $brands_id = DB::table('products')->where('subcategory_id', $subcategory->id)->distinct()->pluck('brand_id');
                    $brands = Brand::whereIn('id', $brands_id)->select('id', 'name','name_ar','slug')->where('status',1)->get();
                    $matching_filters['brands'] = BrandResource::collection($brands);

                } elseif ($request->category_id) {
                    $category = Category::where('slug', $request->category_id)->where('status',1)->with('subcategories.childcategories.brands', 'stores')
                        ->with(['subcategories.childcategories'=>function($query){
                            $query->withCount('products');
                        }, 'subcategories'=>function($query){
                            $query->withCount('products');

                        }])
                        ->withCount('products')
                        ->first();

                    // array_push($filters , $category);
                    $matching_filters['category']=MatchingFiltersResource::make($category);
                    $brands_id = DB::table('products')->where('category_id', $category->id)->distinct()->pluck('brand_id');
                    $brands = Brand::whereIn('id', $brands_id)->select('id', 'name','name_ar','slug')->where('status',1)->get();

                    // solo subcat
                    /* $subcategories = $category->subcategories;

                     // brands
                     $brands = $subcategories->pluck('brands');
                     $brands = $brands->flatten();*/

                    $matching_filters['brands'] =  BrandResource::collection($brands);


                }else{
                    $store = Store::where('slug', $request->stores[0])->first();
                    $categories_id = DB::table('products')->where('store_id', $store->id)->distinct()->pluck('category_id');
                    $brands_id = DB::table('products')->where('store_id', $store->id)->distinct()->pluck('brand_id');
                    $category = Category::with('subcategories.childcategories.brands', 'stores')
                        ->with(['subcategories.childcategories'=>function($query){
                            $query->withCount('products');
                        }, 'subcategories'=>function($query){
                            $query->withCount('products');

                        }])
                        ->withCount('products')
                        ->where('status',1)->whereIn('id', $categories_id)->get();
                    // array_push($filters , $category);
                    $matching_filters['category'] = MatchingFiltersResource::collection($category);
                    $brands = Brand::whereIn('id', $brands_id)->where('status',1)->get();
                    $matching_filters['brands'] = BrandResource::collection($brands);
                }

            } elseif ($request->childcategory_id) {
                $childcategory = ChildCategory::where('slug', $request->childcategory_id)->where('status',1)
                    ->with(['category'=>function($query){
                        $query->withCount('products');
                    }, 'subcategory'=>function($query){
                        $query->withCount('products');

                    }])
                    ->first();
                $category = $childcategory->category->toArray();
                $subcategory = $childcategory->subcategory->toArray();

                // empty matching_filters
                $matching_filters = [];

                // cat
                $matching_filters['category'] = $category;

                // subcat
                $matching_filters['category']['subcategories'] = [];
                array_push($matching_filters['category']['subcategories'], $subcategory);

                // childcat
                $matching_filters['category']['subcategories'][0]['childcategories'] = [];
                array_push($matching_filters['category']['subcategories'][0]['childcategories'], $childcategory);
                $matching_filters['category']=MatchingFiltersResource::make($matching_filters['category']);
//                $brands = $childcategory->brands;

                $brands_id = DB::table('products')->where('childcategory_id', $childcategory->id)->distinct()->pluck('brand_id');
                $brands = Brand::whereIn('id', $brands_id)->select('id', 'name','name_ar','slug')->where('status',1)->get();
                $matching_filters['brands'] = BrandResource::collection($brands);


            } elseif ($request->subcategory_id) {
                $subcategory = SubCategory::where('slug', $request->subcategory_id)->where('status',1)
                    ->with(['category'=>function($query){
                        $query->withCount('products');
                    }, 'childcategories'=>function($query){
                        $query->withCount('products');

                    }])
                    ->first();
                $category = $subcategory->category->toArray();

                // empty matching_filters
                $matching_filters = [];
                // cat
                $matching_filters['category'] = $category;

                // subcat
                $matching_filters['category']['subcategories'] = [];
                array_push($matching_filters['category']['subcategories'], $subcategory);
                $matching_filters['category']=MatchingFiltersResource::make($matching_filters['category']);

                // brands
//                $brands = $subcategory->brands;

                $brands_id = DB::table('products')->where('subcategory_id', $subcategory->id)->distinct()->pluck('brand_id');
                $brands = Brand::whereIn('id', $brands_id)->select('id', 'name','name_ar','slug')->where('status',1)->get();
                $matching_filters['brands'] = BrandResource::collection($brands);

            } elseif ($request->category_id) {
                $category = Category::where('slug', $request->category_id)->where('status',1)->with('subcategories.childcategories.brands', 'stores')
                    ->with(['subcategories.childcategories'=>function($query){
                        $query->withCount('products');
                    }, 'subcategories'=>function($query){
                        $query->withCount('products');

                    }])
                    ->first();
                // array_push($filters , $category);
                $matching_filters['category']=MatchingFiltersResource::make($category);
                $brands_id = DB::table('products')->where('category_id', $category->id)->distinct()->pluck('brand_id');
                $brands = Brand::whereIn('id', $brands_id)->select('id', 'name','name_ar','slug')->where('status',1)->get();

                // solo subcat
               /* $subcategories = $category->subcategories;

                // brands
                $brands = $subcategories->pluck('brands');
                $brands = $brands->flatten();*/

                $matching_filters['brands'] =  BrandResource::collection($brands);


            } elseif($request->brands) {
                $categories_ids = DB::table('products')->whereIn('brand_id', $brands)->distinct()->pluck('category_id');
                $category = Category::with('subcategories.childcategories.brands', 'stores')
                    ->with(['subcategories.childcategories'=>function($query){
                        $query->withCount('products');
                    }, 'subcategories'=>function($query){
                        $query->withCount('products');

                    }])
                    ->withCount('products')
                    ->whereIn('id', $categories_ids)->get();
                $matching_filters['category'] = MatchingFiltersResource::collection($category);
                $brands = Brand::whereIn('id', $brands)->select('id', 'name','name_ar','slug')->where('status',1)->get();
                $matching_filters['brands'] = BrandResource::collection($brands);
            }else {
                $category = Category::with('subcategories.childcategories.brands', 'stores')
                    ->with(['subcategories.childcategories'=>function($query){
                        $query->withCount('products');
                    }, 'subcategories'=>function($query){
                        $query->withCount('products');

                    }])
                    ->withCount('products')
                    ->get();
                $matching_filters['category'] = MatchingFiltersResource::collection($category);
                $brands_id = DB::table('products')->distinct()->pluck('brand_id');
                $brands = Brand::whereIn('id', $brands_id)->select('id', 'name','name_ar','slug')->where('status',1)->get();

//                $brands = Brand::select('id', 'name','name_ar','slug')->where('status',1)->get();
                $matching_filters['brands'] = BrandResource::collection($brands);
            }
//            dd($matching_filters);
            // applied filters
            $filters = [];

            if ($request->stores) {
                $stores = [];
                if ($request->stores) {
                    foreach ($request->stores as $store) {
                        $data = Store::where('slug', $store)->first();
                        if ($data) {
                            $stores[] = $data->id;
                        }

                    }
                }
                $stores = Store::whereIn('id', $stores)->get();
                foreach ($stores as $store) {

                    array_push($filters, $store);
                }

            }

            if ($request->brands) {
                $brands = [];
                if ($request->brands) {
                    foreach ($request->brands as $brand) {
                        $data = Brand::where('slug', $brand)->first();
                        if ($data) {
                            $brands[] = $data->id;
                        }

                    }
                }
                $brands = Brand::whereIn('id', $brands)->get();
                foreach ($brands as $brand) {
                    array_push($filters, $brand);
                }

            }
            if ($request->category_id) {
                $category = Category::where('slug', $request->category_id)->first();
                array_push($filters, $category);
            }

            if ($request->subcategory_id) {
                $subcategory = SubCategory::where('slug', $request->subcategory_id)->first();
                array_push($filters, $subcategory);

            }

            if ($request->childcategory_id) {
                $childcategory = ChildCategory::where('slug', $request->childcategory_id)->first();
                array_push($filters, $childcategory);

            }

            $filters=FiltersResource::collection($filters);
//            filters end

            return response()->json([
                'status' => 200,
                'products' => $products->response()->getData(),
                'filters' => $filters,
                'matching_filters' => $matching_filters
            ]);

//        } catch (\Throwable $th) {
//
////            throw $th;
//            return response()->json([
//                "status" => 100,
//                "message" => "Sorry! Something Went Wrong.",
//                "exceptions" => $th
//            ]);
//        }
    }

}
