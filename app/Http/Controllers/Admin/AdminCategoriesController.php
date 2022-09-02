<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute as ModelsAttribute;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use JWTAuth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Traits\ApiHelper;
use App\Traits\ApiDataGenerate;

class AdminCategoriesController extends Controller
{

    use ApiHelper, ApiDataGenerate;

    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index()
    {
      try {
        $categories                = Category::withCount('products')->with('brands')->orderBy('order' , 'ASC')->get();
        $categories_count          = count($categories);
        $active_categories_count   = $categories->where('status',1)->count();
        $inactive_categories_count = $categories->where('status',0)->count();
        $featured_categories_count = $categories->where('featured',1)->count();

        return response()->json([
            'status'             => 200,
            'categories'         => $categories,
            'categories_count'   => $categories_count,
            'active_categories'  => $active_categories_count,
            'inactive_categories'=> $inactive_categories_count,
            'featured_categories'=> $featured_categories_count,
        ]);
      }
      catch (\Exception $e) {
        return response()->json([
            'status'    => 100,
            'message'   => "something went wrong",
            'exception' => $e->getMessage()
        ]);
    }
    }



    /*
    |===================================================
    | Show the form for creating a new resource.
    |===================================================
    */
    public function create()
    {
        $categories = Category::with(['subcategories', 'childcategories', 'brands'])->get();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::all();
        $brands = Brand::all();
        $attributes = ModelsAttribute::all();
        return response()->json([
            'status'     => 200,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'childcategories' => $childcategories,
            'brands' => $brands,
            'attributes' => $attributes,
        ]);


    }


    public function subcategories(Request $request){
        $category = Category::where('id' , $request->id)->with('subcategories')->first();

        return response()->json([
            "status" => 200,
            "subcategories" => $category->subcategories
        ]);

    }



    /*
    |====================================================
    | Store a newly created resource in storage.
    |====================================================
    */
    public function store(Request $request)
    {
        try {

            $validator = \Validator::make( $request->all(), [
                'title'       => ['bail', 'required', 'string','unique:categories', 'max:100'],
                'title_ar'       => ['bail', 'required', 'string','unique:categories', 'max:100'],
                'description' => ['bail', 'max:500'],
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->messages()->all()
                ]);
            }

            $formData = [
                'title'       => $request->title,
                'slug'       => $this->createSlug('categories',$request->title),
                'title_ar'       => $request->title_ar,
                'description' => $request->description,
                'featured'    => $request->featured == "on" ? 1 : 0,
                'popular'     => $request->popular == "on" ? 1 : 0,
                'status'      => $request->status == "on" ? 1 : 0,
            ];

            if ($request->logo_image) {
                $imageName = ApiHelper::uploadFile($request->logo_image , 'public' , 'categories/logo',true);
                $formData['logo_image'] = $imageName;
            }

            if ($request->mobile_image) {
                $imageName = ApiHelper::uploadFile($request->mobile_image , 'public' , 'categories/mobile',true);
                $formData['mobile_image'] = $imageName;
            }

            if ($request->banner_image) {
                $imageName = ApiHelper::uploadFile($request->banner_image , 'public' , 'categories/banner',true);
                $formData['banner_image'] = $imageName;
            }

            $category = new Category();
            $category_count = Category::count();
            $formData['order'] = $category_count +1;
            $isSaved = $category = $category->create($formData);

            if($request->brands){


                // Attach Categories to Brand
                $brands = explode("," , $request->brands);
                $category->brands()->attach($brands);

            }

            if ($isSaved) {
                return response()->json([
                    "status"  => 200,
                    "message" => "Category is Added Successfully",
                ]);

            }

            else{
                return response()->json([
                    "status"  => 100,
                    "message" => "Sorry! Something Went Wrong",
                ]);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status"  => 500,
                "message" => "Sorry! Something Went Wrong.",
                "log" => $th
            ]);
        }
    }



    /*
    |==================================================
    | Display the specified resource.
    |==================================================
    */
    public function show($id)
    {
        $category = Category::where('id' ,$id)->with('brands')->first();
        if($category){
            return response()->json([
                "status" => 200,
                "category" => $category
            ]);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "Category Not Found!"
            ]);
        }
    }



    /*
    |==========================================================
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($id)
    {
        $category = Category::where('id',$id)->with('brands')->first();
        $brands = Brand::all();

        return response()->json([
            'status'   => 200,
            'category' => $category,
            'brands' => $brands
        ]);
    }

    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make( $request->all(), [
            'title'       => ['bail', 'required', 'string',Rule::unique('categories')->ignore($id), 'max:100'],
            'title_ar'       => ['bail', 'required', 'string',Rule::unique('categories')->ignore($id), 'max:100'],
            'description' => ['bail', 'max:500'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'title'       => $request->title,
//            'slug'       => $this->createSlug('categories',$request->title),
            'title_ar'    => $request->title_ar,
            'description' => $request->description,
            'featured'    => $request->featured == "on" ? 1 : 0,
            'popular'     => $request->popular == "on" ? 1 : 0,
            'status'      => $request->status == "on" ? 1 : 0,
        ];


        $category = Category::findOrFail($id);
        if ($request->logo_image) {
            $imageName = ApiHelper::uploadFile($request->logo_image , 'public' , 'categories/logo',true);
            $formData['logo_image'] = $imageName;
        }

        if ($request->mobile_image) {
            $imageName = ApiHelper::uploadFile($request->mobile_image , 'public' , 'categories/mobile',true);
            $formData['mobile_image'] = $imageName;
        }

        if ($request->banner_image) {
            $imageName = ApiHelper::uploadFile($request->banner_image , 'public' , 'categories/banner',true);
            $formData['banner_image'] = $imageName;
        }

        $isUpdated = Category::where('id', $id)->update($formData);


        if($request->brands){
            // Sync Categories to Brand
            $brands = explode("," , $request->brands);
            $category->brands()->sync($brands);

        }
        else{
            $category->brands()->sync([]);

        }

        if ($isUpdated) {
            return response()->json([
                'status'  => 200,
                'message' => 'Category Records Are Updated Successfully'
            ]);
        }

        else{
            return response()->json([
                "status"  => 100,
                "message" => "Sorry! Something Went Wrong",
            ]);
        }

    }


    /*
    |====================================================
    | Remove the specified resource from storage.
    |====================================================
    */
    public function destroy($id)
    {
        $sub_categories_count = SubCategory::where('category_id',$id)->count();
        $category = Category::findOrFail($id);

        if ($category) {

            // // REMOVE LOGO IMAGES
            // if ($category->logo_image != NULL && file_exists(public_path() . '/admin/images/categories/logo/org/' . $category->logo_image)) {
            //     unlink(public_path() . '/admin/images/categories/logo/org/' . $category->logo_image);
            // }

            // if ($category->logo_image != NULL && file_exists(public_path() . '/admin/images/categories/logo/sm/' . $category->logo_image)) {
            //     unlink(public_path() . '/admin/images/categories/logo/sm/' . $category->logo_image);
            // }

            // // REMOVE MOBILE IMAGES
            // if ($category->mobile_image != NULL && file_exists(public_path() . '/admin/images/categories/mobile/org/' . $category->mobile_image)) {
            //     unlink(public_path() . '/admin/images/categories/mobile/org/' . $category->mobile_image);
            // }

            // // REMOVE BANNER IMAGES
            // if ($category->banner_image != NULL && file_exists(public_path() . '/admin/images/categories/banner/org/' . $category->banner_image)) {
            //     unlink(public_path() . '/admin/images/categories/banner/org/' . $category->banner_image);
            // }

            // if ($category->banner_image != NULL && file_exists(public_path() . '/admin/images/categories/banner/sm/' . $category->banner_image)) {
            //     unlink(public_path() . '/admin/images/categories/banner/sm/' . $category->banner_image);
            // }

            $isDeleted = Category::where('id',$id)->delete();

            if ($isDeleted) {

                return response()->json([
                    "status"  => 200,
                    "message" => "Category is Deleted Successfully",
                ]);
            }
            else{
                return response()->json([
                    "status"  => 100,
                    "message" => "Something Went Wrong",
                ]);
            }


        }

        else{
            return response()->json([
                "status"  => 404,
                "message" => "Category Not Found !",
            ]);
        }
    }


    public function showArchive(){

        $categories  = Category::onlyTrashed()->orderBy('updated_at' , 'ASC')->get();


        return response()->json([
            'status'             => 200,
            'categories'         => $categories,

        ]);

    }

    public function restoreCategory(Request $request){
        try {
            $category = Category::where("id" , $request->id)->withTrashed()->first();

            // dd($category);

            if($category){
                $category->restore();
                $category_count = Category::count();
                $category->order = $category_count ;
                $category->save();
                return response()->json([
                    "status"  => 200,
                    "message" => "Restored Successfully! ",

                ]);
            }
            else{
                return response()->json([
                    "status"  => 404,
                    "message" => "Category Not Found ! ",

                ]);
            }




        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status"  => 500,
                "message" => "Sorry! Something Went Wrong.",
                "log" => $th
            ]);
        }


    }


    public function orderUpdate(Request $request){
        $values = [];
        $data = $request->all();

        $categoryInstance = new Category;

        $index = 'id';

        $res  = \Batch::update($categoryInstance, $data, $index);

        if($res > 0){
            return response()->json([
                "status"  => 200,
                "message" => "Ordered Successfully! ",

            ]);
        }
        else{
            return response()->json([
                "status"  => 500,
                "message" => "Somthing Went wrong! ",

            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            if ($request->has('status')) {
                Category::where('id', $request->category_id)->update(['status' => $request->status]);
            } elseif($request->has('featured')) {
                Category::where('id', $request->category_id)->update(['featured' => $request->featured]);
            }else{
                Category::where('id', $request->category_id)->update(['popular' => $request->popular]);
            }
            return response()->json(['status' => 200, 'success' => 'Status changed successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
