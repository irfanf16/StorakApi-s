<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\Store;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductsController extends Controller
{
    /*
    |============================================================
    | Get Listing of All Products From Storage --
    |============================================================
     */
    public function index(Request $request)
    {
        try {
            $products = Product::query()
                ->with('category:id,title')
                ->with('subcategory:id,title')
                ->with('childcategory:id,title')
                ->with('brand:id,name')
                ->with('store:id,store_name')
                ->with('variants.variantAttributes', function ($query) {
                    $query->with('attributeDetail:id,title');
                    $query->with('keyDetail:id,name');
                })
                ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . "%");
                })
                ->when($request->has('category_id') && $request->filled('category_id'), function ($query) use ($request) {
                    $query->where('category_id',$request->category_id);
                })
                ->when($request->has('subcategory_id') && $request->filled('subcategory_id'), function ($query) use ($request) {
                    $query->where('subcategory_id',$request->subcategory_id);
                })
                ->when($request->has('childcategory_id') && $request->filled('childcategory_id'), function ($query) use ($request) {
                    $query->where('childcategory_id',$request->childcategory_id);
                })
                ->when($request->has('store_id') && $request->filled('store_id'), function ($query) use ($request) {
                    $query->where('store_id',$request->store_id);
                })
                ->when($request->has('brand_id') && $request->filled('brand_id'), function ($query) use ($request) {
                    $query->where('brand_id',$request->brand_id);
                })
                ->when($request->has('status') && $request->filled('status'), function ($query) use ($request) {
                    $query->where('status',$request->status);
                })
                ->when($request->has('featured') && $request->filled('featured'), function ($query) use ($request) {
                    $query->where('featured',$request->featured);
                })
                ->when($request->has('from_date') && $request->filled('from_date'), function ($query) use ($request) {
                    $query->where('created_at','>',$request->from_date);
                })
                ->when($request->has('from_to') && $request->filled('from_to'), function ($query) use ($request) {
                    $query->where('created_at','<',$request->from_to);
                })
                ->when($request->has('translation') && $request->filled('translation'), function ($query) use ($request) {
                    $query->where('translation_verified', $request->translation);
                })
                ->latest()
                ->paginate($request->datatable_length);

            return response()->json([
                'status' => 200,
                'products' => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "sorry, something went wrong",
                'errors' => $e->getMessage(),
            ]);
        }

    }

    public function countProduct()
    {
        try {
            $products = Product::all();
            $products_count = count($products);
            $active_products = $products->where('status', 1)->count();
            $inactive_products = $products->where('status', 0)->count();
            $featured_products = $products->where('featured', 1)->count();

            $categories=Category::whereHas('products')->where('status',1)->select('id','title')->get();
            $sub_categories=SubCategory::whereHas('products')->where('status',1)->select('id','title')->get();
            $child_categories=SubCategory::whereHas('products')->where('status',1)->select('id','title')->get();
            $stores=Store::whereHas('products')->where('status',1)->select('id','store_name')->get();
            $brands=Brand::whereHas('products')->where('status',1)->select('id','name')->get();


            return response()->json([
                'status' => 200,
                // 'products' => $products,
                'products_count' => $products_count,
                'active_products' => $active_products,
                'inactive_products' => $inactive_products,
                'featured_products' => $featured_products,
                'categories' => $categories,
                'sub_categories' => $sub_categories,
                'child_categories' => $child_categories,
                'stores' => $stores,
                'brands' => $brands,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "sorry, something went wrong",
                'errors' => $e->getMessage(),
            ]);
        }
    }

    /*
    |============================================================
    | Get Required Data For Create A New Product Page --
    |============================================================
     */
    public function create()
    {
        //
    }

    /*
    |==============================================================
    | Store a Newly Created Product In Storage --
    |==============================================================
     */
    public function store(Request $request)
    {
        //
    }

    /*
    |===============================================================
    | Get Specified Product Details From Storage --
    |===============================================================
     */
    public function show($id)
    {
        try {
            $product = Product::where('id', $id)->first();

            $stores = Store::select('id', 'store_name')
                ->orderBy('store_name', 'asc')
                ->get();

            $brands = Brand::select('id', 'name')
                ->where('status', 1)
                ->orderBy('name', 'asc')
                ->get();

            $categories = Category::select('id', 'title')
                ->where('status', 1)
                ->orderBy('title', 'asc')
                ->get();

            $subcategories = SubCategory::select('id', 'title')
                ->where([
                    'category_id' => $product->category_id,
                    'status' => 1,
                ])
                ->orderBy('title', 'asc')
                ->get();

            $childcategories = ChildCategory::select('id', 'title')
                ->where([
                    'subcategory_id' => $product->subcategory_id,
                    'status' => 1,
                ])
                ->orderBy('title', 'asc')
                ->get();

            return response()->json([
                'status' => 200,
                'product' => $product,
                'stores' => $stores,
                'brands' => $brands,
                'categories' => $categories,
                'subcategories' => $subcategories,
                'childcategories' => $childcategories,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "sorry, something went wrong",
                'errors' => $e->getMessage(),
            ]);
        }

    }

    /*
    |=================================================================
    | Edit Specified Product From Storage --
    |=================================================================
     */
    public function edit($id)
    {
        //
    }

    /*
    |=================================================================
    | Update The Specified Product in Storage --
    |=================================================================
     */
    public function update(Request $request, $id)
    {
        //
    }

    /*
    |=================================================================
    | Remove The Specified Product From Storage --
    |=================================================================
     */
    public function destroy($id)
    {
        try {
            Product::where('id', $id)
                ->delete();

            return response()->json([
                "status" => 200,
                "message" => "Product is moved to trash successfully",
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "sorry, something went wrong",
                'errors' => $e->getMessage(),
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            if ($request->has('status')) {
                Product::where('id', $request->product_id)->update(['status' => $request->status]);
            } elseif($request->has('featured')) {
                Product::where('id', $request->product_id)->update(['featured' => $request->featured]);
            } else {
                Product::where('id', $request->product_id)->update(['translation_verified' => $request->translation]);
            }
            return response()->json(['status' => 200, 'success' => 'Status changed successfully.', 'request' => $request->all()]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage(),
                
            ]);
        }
    }

    public function editTranslation($id)
    {
        $product = Product::select('id', 'name', 'name_ar', 'short_description', 'short_description_ar', 'detailed_description',  'detailed_description_ar',  'status', 'translation_verified')->find($id);
        if (str_contains($product->detailed_description,'storage/product/detail')){
            $eng =  $product->detailed_description;
            $arabic =  $product->detailed_description_ar;

            $filename = str_replace("storage/product/detail/", "", $eng);
            $filename_ar = str_replace("storage/product/detail/", "", $arabic);
            $file = Storage::disk('product')->get("detail/$filename");
            $file_ar = Storage::disk('product')->get("detail/$filename_ar");
            $product['detailed_description'] = (json_decode($file))->content;
            $product['detailed_description_ar'] = (json_decode($file_ar))->content;

        }
        $product = json_decode(json_encode($product));
        return response()->json([
            'status'  => 200,
            'product' => $product
        ]);
    }

    public function updateTranslation(Request $request, $id)
    {
        // $product = ($request->all());
        $product = Product::find($id);
        
        if (str_contains($product->detailed_description,'storage/product/detail')){
            $eng =  $product->detailed_description;
            $arabic =  $product->detailed_description_ar;
            $file_code = str_replace("storage/product/detail/", "", $eng);
            $file_code_ar = str_replace("storage/product/detail/", "", $arabic);

            // STORE PRODUCT DETAIL DESCRIPTION
            Storage::disk('product')->put("detail/$file_code.json", json_encode([
                'content' => $request->detailed_description,
            ]));

            Storage::disk('product')->put("detail/$file_code_ar.json", json_encode([
                'content' => $request->detailed_description_ar,
            ]));

        }else{
            // STORE PRODUCT DETAIL DESCRIPTION
            $file_code = $this->randomStr(12);
            Storage::disk('product')->put("detail/$file_code.json", json_encode([
                'content' => $request->detailed_description,
            ]));

            $file_code_ar = $this->randomStr(12);
            Storage::disk('product')->put("detail/$file_code_ar.json", json_encode([
                'content' => $request->detailed_description_ar,
            ]));
//            die($request->detailed_description);
        }
        $product->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'short_description' => $request->short_description,
            'short_description_ar' => $request->short_description_ar,
            'detailed_description' => "storage/product/detail/$file_code.json",
            'detailed_description_ar' => "storage/product/detail/$file_code_ar.json",
            'translation_verified' => $request->translation_verified ? 1 : 0,
            'status' => $request->status ? 1 : 0,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Product Translation Updated ',
            'procuct' => $product
        ]);
    }

    public function randomStr($strength)
    {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

}
