<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Collection;
use App\Models\Key;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Store;
use App\Models\SubCategory;
use App\Models\Translation;
use App\Models\UserStore;
use App\Traits\ApiDataGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationController extends Controller
{
    use ApiDataGenerate;

//    public function translationOld()
//    {
//
//        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
//        $categories = Category::all();
//        foreach ($categories as $category) {
//
//            Translation::updateOrCreate(['table_name' => 'categories', 'column_name' => 'title', 'record_id' => $category->id, 'lang' => 'ar'], [
//                'table_name' => 'categories',
//                'column_name' => 'title',
//                'lang' => 'ar',
//                'record_id' => $category->id,
//                'translation' => GoogleTranslate::trans($category->title ?? 'Not Provided', 'ar')
//            ]);
//        }
//        $subcategories = SubCategory::all();
//        foreach ($subcategories as $category) {
//
//            Translation::updateOrCreate(['table_name' => 'sub_categories', 'column_name' => 'title', 'record_id' => $category->id, 'lang' => 'ar'], [
//                'table_name' => 'sub_categories',
//                'column_name' => 'title',
//                'lang' => 'ar',
//                'record_id' => $category->id,
//                'translation' => GoogleTranslate::trans($category->title ?? 'Not Provided', 'ar')
//            ]);
//        }
//        $childcategories = ChildCategory::all();
//        foreach ($childcategories as $category) {
//
//            Translation::updateOrCreate(['table_name' => 'child_categories', 'column_name' => 'title', 'record_id' => $category->id, 'lang' => 'ar'], [
//                'table_name' => 'child_categories',
//                'column_name' => 'title',
//                'lang' => 'ar',
//                'record_id' => $category->id,
//                'translation' => GoogleTranslate::trans($category->title ?? 'Not Provided', 'ar')
//            ]);
//        }
//        $brands = Brand::all();
//        foreach ($brands as $brand) {
//
//            Translation::updateOrCreate(['table_name' => 'brands', 'column_name' => 'name', 'record_id' => $brand->id, 'lang' => 'ar'], [
//                'table_name' => 'brands',
//                'column_name' => 'name',
//                'lang' => 'ar',
//                'record_id' => $brand->id,
//                'translation' => GoogleTranslate::trans($brand->name ?? 'Not Provided', 'ar')
//            ]);
//        }
//        $stores = Store::all();
//        foreach ($stores as $store) {
//
//            Translation::updateOrCreate(['table_name' => 'stores', 'column_name' => 'store_name', 'record_id' => $store->id, 'lang' => 'ar'], [
//                'table_name' => 'stores',
//                'column_name' => 'store_name',
//                'lang' => 'ar',
//                'record_id' => $store->id,
//                'translation' => GoogleTranslate::trans($store->store_name ?? 'Not Provided', 'ar')
//            ]);
//            if ($store->tag_line) {
//                Translation::updateOrCreate(['table_name' => 'stores', 'column_name' => 'tag_line', 'record_id' => $store->id, 'lang' => 'ar'], [
//                    'table_name' => 'stores',
//                    'column_name' => 'tag_line',
//                    'lang' => 'ar',
//                    'record_id' => $store->id,
//                    'translation' => GoogleTranslate::trans($store->tag_line ?? 'Not Provided', 'ar')
//                ]);
//            }
//            if ($store->short_description) {
//                Translation::updateOrCreate(['table_name' => 'stores', 'column_name' => 'short_description', 'record_id' => $store->id, 'lang' => 'ar'], [
//                    'table_name' => 'stores',
//                    'column_name' => 'short_description',
//                    'lang' => 'ar',
//                    'record_id' => $store->id,
//                    'translation' => GoogleTranslate::trans($store->short_description ?? 'Not Provided', 'ar')
//                ]);
//            }
//            if ($store->detailed_description) {
//                Translation::updateOrCreate(['table_name' => 'stores', 'column_name' => 'detailed_description', 'record_id' => $store->id, 'lang' => 'ar'], [
//                    'table_name' => 'stores',
//                    'column_name' => 'detailed_description',
//                    'lang' => 'ar',
//                    'record_id' => $store->id,
//                    'translation' => GoogleTranslate::trans($store->detailed_description ?? 'Not Provided', 'ar')
//                ]);
//            }
//
//        }
//        $userStores = UserStore::all();
//        foreach ($userStores as $store) {
//
//            Translation::updateOrCreate(['table_name' => 'user_stores', 'column_name' => 'name', 'record_id' => $store->id, 'lang' => 'ar'], [
//                'table_name' => 'user_stores',
//                'column_name' => 'name',
//                'lang' => 'ar',
//                'record_id' => $store->id,
//                'translation' => GoogleTranslate::trans($store->name ?? 'Not Provided', 'ar')
//            ]);
//            if ($store->tag_line) {
//                Translation::updateOrCreate(['table_name' => 'user_stores', 'column_name' => 'tag_line', 'record_id' => $store->id, 'lang' => 'ar'], [
//                    'table_name' => 'user_stores',
//                    'column_name' => 'tag_line',
//                    'lang' => 'ar',
//                    'record_id' => $store->id,
//                    'translation' => GoogleTranslate::trans($store->tag_line ?? 'Not Provided', 'ar')
//                ]);
//            }
//            if ($store->description) {
//                Translation::updateOrCreate(['table_name' => 'user_stores', 'column_name' => 'description', 'record_id' => $store->id, 'lang' => 'ar'], [
//                    'table_name' => 'user_stores',
//                    'column_name' => 'description',
//                    'lang' => 'ar',
//                    'record_id' => $store->id,
//                    'translation' => GoogleTranslate::trans($store->description ?? 'Not Provided', 'ar')
//                ]);
//            }
//        }
//        $attributes = Attribute::all();
//        foreach ($attributes as $attribute) {
//
//            Translation::updateOrCreate(['table_name' => 'attributes', 'column_name' => 'title', 'record_id' => $attribute->id, 'lang' => 'ar'], [
//                'table_name' => 'attributes',
//                'column_name' => 'title',
//                'lang' => 'ar',
//                'record_id' => $attribute->id,
//                'translation' => GoogleTranslate::trans($attribute->title ?? 'Not Provided', 'ar')
//            ]);
//        }
//
//        $collections = Collection::all();
//        foreach ($collections as $collection) {
//
//            Translation::updateOrCreate(['table_name' => 'collections', 'column_name' => 'name', 'record_id' => $collection->id, 'lang' => 'ar'], [
//                'table_name' => 'collections',
//                'column_name' => 'name',
//                'lang' => 'ar',
//                'record_id' => $collection->id,
//                'translation' => GoogleTranslate::trans($collection->name ?? 'Not Provided', 'ar')
//            ]);
//        }
//        $keys = Key::all();
//        foreach ($keys as $key) {
//
//            Translation::updateOrCreate(['table_name' => 'keys', 'column_name' => 'name', 'record_id' => $key->id, 'lang' => 'ar'], [
//                'table_name' => 'keys',
//                'column_name' => 'name',
//                'lang' => 'ar',
//                'record_id' => $key->id,
//                'translation' => GoogleTranslate::trans($key->name ?? 'Not Provided', 'ar')
//            ]);
//        }
//        $categories = Translation::where(['table_name' => 'categories', 'column_name' => 'title'])->get();
//        $subcategories = Translation::where(['table_name' => 'subcategory', 'column_name' => 'title'])->get();
//        $childcategories = Translation::where(['table_name' => 'childcategory', 'column_name' => 'title'])->get();
//        $brands = Translation::where(['table_name' => 'brand', 'column_name' => 'name'])->get();
//        $stores = Translation::where(['table_name' => 'stores'])->get();
//        $user_stores = Translation::where(['table_name' => 'user_stores'])->get();
//        $attributes = Translation::where(['table_name' => 'attributes', 'column_name' => 'title'])->get();
//        $keys = Translation::where(['table_name' => 'keys', 'column_name' => 'name'])->get();
//        $collections = Translation::where(['table_name' => 'collections', 'column_name' => 'name'])->get();
//
//
//        dd($categories, $subcategories, $childcategories, $brands, $stores, $user_stores, $attributes, $keys, $collections);
//    }


    public function slugs()
    {
//        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
//        DB::table('categories')->update(array('slug' => null));
//        $categories = Category::withTrashed()->get();
//        foreach ($categories as $category) {
//            $slug = $this->createSlug('categories',$category->title);
//            $category->slug = $slug;
//            $category->save();
//        }
//        DB::table('sub_categories')->update(array('slug' => null));
//        $subcategories = SubCategory::all();
//        foreach ($subcategories as $category) {
//            $slug = $this->createSlug('sub_categories',$category->title);
//            $category->slug = $slug;
//            $category->save();
//        }
//        DB::table('child_categories')->update(array('slug' => null));
//        $childCategories = ChildCategory::all();
//        foreach ($childCategories as $category) {
//            $slug = $this->createSlug('child_categories',$category->title);
//            $category->slug = $slug;
//            $category->save();
//        }
//        DB::table('brands')->update(array('slug' => null));
//        $brands = Brand::all();
//        foreach ($brands as $brand) {
//            $slug = $this->createSlug('brands',$brand->name);
//            $brand->slug = $slug;
//            $brand->save();
//        }
//        DB::table('stores')->update(array('slug' => null));
//
//        $stores = Store::all();
//        foreach ($stores as $store) {
//            $slug = $this->createSlug('stores',$store->store_name);
//            $store->slug = $slug;
//            $store->save();
//        }
//        DB::table('user_stores')->update(array('slug' => null));
//        $user_stores = UserStore::all();
//        foreach ($user_stores as $store) {
//            $slug = $this->createSlug('user_stores',$store->name);
//            $store->slug = $slug;
//
//            $store->save();
//        }
//        DB::table('attributes')->update(array('slug' => null));
//        $attributes = Attribute::all();
//        foreach ($attributes as $attribute) {
//            $slug = $this->createSlug('attributes',$attribute->title);
//            $attribute->slug = $slug;
//            $attribute->save();
//        }
        DB::table('collections')->update(array('slug' => null));
        $collections = Collection::all();
        foreach ($collections as $collection) {
            $slug = $this->createSlug('collections',$collection->name);
            $collection->slug = $slug;
            $collection->save();
        }

//        DB::table('products')->update(array('slug' => null));
//        $products = Product::all();
//        foreach ($products as $product) {
//           $product->slug=$this->createSlug('products',$product->name);
//            $product->save();
//        }
//        DB::table('keys')->update(array('slug' => null));
//        $keys = Key::all();
//        foreach ($keys as $key) {
//            $key->slug = $this->createSlug('keys',$key->name);
//            $key->save();
//        }
        dd('slugs generated successfully');
    }

    public function slugsProducts(){

        DB::table('products')->update(array('slug' => null));
        $products = Product::all();
        foreach ($products as $product) {
            $product->slug=$this->createSlug('products',$product->name);
            $product->save();
        }
        dd('slugs generated successfully');

    }

//    translation

    public function translationKeys(Request $request)
    {
        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
        $keys = Key::paginate($request->paginate ?? 10);
        foreach ($keys as $key) {
            $key->name_ar =$this->translate($key->name ?? 'Not Provided', 'ar');
            $key->save();
        }
        dd('translated successfully',$keys);
    }

    public function productTranslation(Request $request)
    {
        try {
        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
        $products = Product::where('name_ar',null)->paginate($request->paginate ?? 100);
        foreach ($products as $product) {
            $item_id=$product->id;
            $file_code = $this->randomStr(12);
            if (str_contains($product->detailed_description,'storage/product/detail')){
                $var1 =  $product->detailed_description;
                $filename = str_replace("storage/product/detail/", "", $var1);
                $file=Storage::disk('product')->get("detail/$filename");
//                $file='https://api.storak.qa/'.$var1;

//                dd(json_decode(file_get_contents($file))->content);
                $ar_file= $this->translate( (json_decode($file))->content ?? 'Not provided','ar');

                // STORE PRODUCT DETAIL DESCRIPTION
                Storage::disk('product')->put("detail/$file_code.json", json_encode([
                    'content' => $ar_file,
                ]));
            }else{
                $ar_file= $this->translate( $product->detailed_description ?? 'Noat Provided','ar');
                // STORE PRODUCT DETAIL DESCRIPTION
                Storage::disk('product')->put("detail/$file_code.json", json_encode([
                    'content' => $ar_file,
                ]));
            }
            $product->name_ar = $this->translate($product->name ?? 'Not Provided', 'ar');
            $product->short_description_ar = $this->translate($product->short_description ?? 'Not Provided', 'ar');
            $product->detailed_description_ar= "storage/product/detail/$file_code.json";
            $product->save();
        }
        dd('translated successfully',$products);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage(),
                'item_id'=>$item_id

            ]);
        }
    }

    public function categoryTranslation(){
        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->title_ar = $this->translate($category->title ?? 'Not Provided', 'ar');
            $category->save();
        }

        $subcategories = SubCategory::all();
        foreach ($subcategories as $category) {
            $category->title_ar = $this->translate($category->title ?? 'Not Provided', 'ar');
            $category->save();
        }

        $childCategories = ChildCategory::all();
        foreach ($childCategories as $category) {
            $category->title_ar = $this->translate($category->title ?? 'Not Provided', 'ar');
            $category->save();
        }
        dd('translated successfully');

    }
    public function brandsTranslation(Request $request){
        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
        $brands = Brand::where('name_ar',null)->paginate($request->paginate ?? 10);
        foreach ($brands as $brand) {
            $brand->name_ar = $this->translate($brand->name ?? 'Not Provided', 'ar');
            $brand->save();
        }
        dd('translated successfully',$brands);

    }
    public function orderStatusTranslation(Request $request){
        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
        $orderStatus = OrderStatus::where('status_ar',null)->paginate($request->paginate ?? 10);
        foreach ($orderStatus as $status) {
            $status->status_ar = $this->translate($status->status ?? 'Not Provided', 'ar');
            $status->message_ar = $this->translate($status->message ?? 'Not Provided', 'ar');
            $status->description_ar = $this->translate($status->description ?? 'Not Provided', 'ar');
            $status->save();
        }
        dd('translated successfully',$orderStatus);

    }
    public function storeTranslation(){
        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
        $stores = Store::all();
        foreach ($stores as $store) {
            $store->store_name_ar =$this->translate($store->store_name ?? 'Not Provided', 'ar');
            $store->tag_line_ar = $this->translate($store->tag_line ?? 'Not Provided', 'ar');
            $store->short_description_ar = $this->translate($store->short_description ?? 'Not Provided', 'ar');
            $store->detailed_description_ar = $this->translate($store->detailed_description ?? 'Not Provided', 'ar');
            $store->save();
        }
        dd('translated successfully');

    }
    public function userStoreTranslation(){
        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
        $user_stores = UserStore::all();
        foreach ($user_stores as $store) {
            $store->name_ar = $this->translate($store->name ?? 'Not Provided', 'ar');
            $store->tag_line_ar = $this->translate($store->tag_line ?? 'Not Provided', 'ar');
            $store->description_ar =$this->translate($store->description ?? 'Not Provided', 'ar');
            $store->save();
        }
        dd('translated successfully');

    }
    public function attributesTranslation(){
        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
        $attributes = Attribute::all();
        foreach ($attributes as $attribute) {
            $attribute->title_ar =$this->translate($attribute->title ?? 'Not Provided', 'ar');
            $attribute->save();
        }
        dd('translated successfully');
    }
    public function collectionsTranslation(){
        ini_set('max_execution_time', '600'); //300 seconds = 5 minutes
        $collections = Collection::all();
        foreach ($collections as $collection) {
            $collection->name_ar = $this->translate($collection->name ?? 'Not Provided', 'ar');
            $collection->save();
        }
        dd('translated successfully');
    }
}
