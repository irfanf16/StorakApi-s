<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Traits\ApiDataGenerate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Traits\ApiHelper;
use App\Models\Brand;
use App\Models\Key;

class AdminSubcategoriesController extends Controller
{
    use ApiHelper,ApiDataGenerate;

    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index(Request $request)
    {
        try {
            $subcategories = SubCategory::query()
                ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                    $query->where('title', 'LIKE', '%' . $request->search . "%");
                })->withCount('products')->with('category:id,title')
                ->latest()
                ->paginate($request->datatable_length);

            return response()->json([
                'status' => 200,
                'subcategories' => $subcategories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function countSub()
    {
        try {
            $subcategories = SubCategory::with('category')->orderBy('order', 'ASC')->get();
            $subcategories_count = count($subcategories);
            $active_subcategories_count = $subcategories->where('status', 1)->count();
            $inactive_subcategories_count = $subcategories->where('status', 0)->count();
            $featured_subcategories_count = $subcategories->where('featured', 1)->count();

            return response()->json([
                'status' => 200,
                'subcategories' => $subcategories,
                'subcategories_count' => $subcategories_count,
                'active_subcategories' => $active_subcategories_count,
                'inactive_subcategories' => $inactive_subcategories_count,
                'featured_subcategories' => $featured_subcategories_count
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
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
        $attributes = Attribute::all();
        $keys = Key::all();
        return response()->json([
            'status' => 200,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'childcategories' => $childcategories,
            'brands' => $brands,
            'attributes' => $attributes,
            'keys' => $keys
        ]);
    }


    public function childcategories(Request $request)
    {
        $subcategory = SubCategory::where('id', $request->id)->with('childcategories')->first();
        return response()->json([
            "status" => 200,
            "childcategories" => $subcategory->childcategories
        ]);

    }


    /*
    |====================================================
    | Store a newly created resource in storage.
    |====================================================
    */
    public function store(Request $request)
    {

        // return $request->all();
        try {
            $validator = \Validator::make($request->all(), [
                'category_id' => ['bail', 'required', 'integer'],
                'title' => ['bail', 'required', 'string', 'max:100'],
                'title_ar' => ['bail', 'required', 'string', 'max:100'],
                'description' => ['bail', 'max:500'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->messages()->all()
                ]);
            }

            // IF VALIDATION PASSES INITIALIZE ARRAY OF FORMDATA
            $formData = [
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug'       => $this->createSlug('sub_categories',$request->title),
                'title_ar' => $request->title_ar,
                'description' => $request->description,
                'featured' => $request->featured == "on" ? 1 : 0,
                'status' => $request->status == "on" ? 1 : 0,
            ];

            // IF STORE-REQUEST HAS IMAGE
            if ($request->image) {
                $imageName = self::uploadFile($request->image, 'public', '/subcategories/image', true);
                $formData['image'] = $imageName;
            }

            // CREATE NEW OBJECT OF CATEGORY
            $subcategory = new SubCategory();
            $subcategory_count = SubCategory::count();
            $formData['order'] = $subcategory_count + 1;
            $isSaved = $subcategory = $subcategory->create($formData);


            if ($request->attributes) {
                $attr = json_decode($request->input('attributes'));
                $subcategory->attributes()->attach($attr);
            }

            if ($request->brands) {
                $attr = json_decode($request->input('brands'));
                $subcategory->brands()->attach($attr);
            }

            if ($isSaved) {
                return response()->json([
                    "status" => 200,
                    "message" => "Subcategory Added Successfully",
                ]);
            } else {
                return response()->json([
                    "status" => 100,
                    "message" => "Sorry! Something Went Wrong",
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;

            return response()->json([
                "status" => 500,
                "message" => "Sorry! Something Went Wrong",
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
        $subcategory = SubCategory::where('id', $id)->with(['attributes', 'category', 'brands'])->first();


        return response()->json([
            'status' => 200,
            'subcategory' => $subcategory,

        ]);
    }


    /*
    |==========================================================
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($id)
    {
        $subcategory = SubCategory::with('brands', 'attributes')->where('id', $id)->first();
        $categories = Category::select('id', 'title')->get();
        $attributes = Attribute::all();
        $brands = Brand::all();

        return response()->json([
            'status' => 200,
            'categories' => $categories,
            'subcategory' => $subcategory,
            'attributes' => $attributes,
            'brands' => $brands,

        ]);
    }


    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'category_id' => ['bail', 'required', 'integer'],
            'title' => ['bail', 'required', 'string', 'max:100'],
            'title_ar' => ['bail', 'required', 'string', 'max:100'],
            'description' => ['bail', 'max:500']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        // IF REQUEST HAS IMAGE, VALIDATE IT
        // if ($request->image) {
        //     $validator = \Validator::make( $request->all(), [
        //         'image' => ['bail', 'mimes:jpeg,png,jpg,gif'],
        //     ]);
        // }

        // if($validator->fails()){
        //     return response()->json([
        //         'status' => 100,
        //         'errors' => $validator->messages()->all()
        //     ]);
        // }

        // IF VALIDATION PASSES INITIALIZE ARRAY OF FORMDATA
        $formData = [
            'category_id' => $request->category_id,
            'title' => $request->title,
//            'slug'       => $this->createSlug('categories',$request->title),
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'featured' => $request->featured == "on" ? 1 : 0,
            'status' => $request->status == "on" ? 1 : 0,
        ];

        // IF UPDATE-REQUEST HAS IMAGE
        if ($request->image) {
            $imageName = self::uploadFile($request->image, 'public', '/subcategories/image', true);
            $formData['image'] = $imageName;
        }


        $isUpdated = SubCategory::where('id', $id)->update($formData);
        $subcategory = SubCategory::where('id', $id)->first();

        if ($request->attributes) {
            $attr = json_decode($request->input('attributes'));
            $subcategory->attributes()->sync($attr);
        }

        if ($request->brands) {
            $attr = json_decode($request->input('brands'));
            $subcategory->brands()->sync($attr);
        }


        if ($isUpdated) {
            return response()->json([
                'status' => 200,
                'message' => 'Subcategory Records Are Updated Successfully'
            ]);
        } else {
            return response()->json([
                "status" => 100,
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
        $child_categories_count = ChildCategory::where('subcategory_id', $id)->count();
        $subcategory = SubCategory::findOrFail($id);

        if ($subcategory) {

            // // REMOVE EXISTING IMAGES
            // if ($subcategory->image != NULL && file_exists(public_path() . '/admin/images/subcategories/org/' . $subcategory->image)) {
            //     unlink(public_path() . '/admin/images/subcategories/org/' . $subcategory->image);
            // }
            // if ($subcategory->image != NULL && file_exists(public_path() . '/admin/images/subcategories/md/' . $subcategory->image)) {
            //     unlink(public_path() . '/admin/images/subcategories/md/' . $subcategory->image);
            // }
            // if ($subcategory->image != NULL && file_exists(public_path() . '/admin/images/subcategories/sm/' . $subcategory->image)) {
            //     unlink(public_path() . '/admin/images/subcategories/sm/' . $subcategory->image);
            // }

            $isDeleted = SubCategory::where('id', $id)->delete();

            if ($isDeleted) {

                return response()->json([
                    "status" => 200,
                    "message" => "Subcategory is Deleted Successfully!",
                ]);
            }

            return response()->json([
                "status" => 100,
                "message" => "Something Went Wrong",
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "Sub Category Not Found !",
            ]);
        }
    }


    public function showArchive()
    {

        $subCategory = SubCategory::onlyTrashed()->orderBy('updated_at', 'ASC')->get();


        return response()->json([
            'status' => 200,
            'subcategories' => $subCategory,

        ]);

    }

    public function restoreCategory(Request $request)
    {
        try {
            $subCategory = SubCategory::where("id", $request->id)->withTrashed()->first();
            // return $subCategory;/

            if ($subCategory) {
                $subCategory->restore();
                $subCategory_count = SubCategory::count();
                $subCategory->order = $subCategory_count;
                $subCategory->save();
                return response()->json([
                    "status" => 200,
                    "message" => "Restored Successfully! ",

                ]);
            } else {
                return response()->json([
                    "status" => 404,
                    "message" => "SubCategory Not Found ! ",

                ]);
            }


        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status" => 500,
                "message" => "Sorry! Something Went Wrong.",
                "log" => $th
            ]);
        }


    }


    public function orderUpdate(Request $request)
    {
        $values = [];
        $data = $request->all();

        $categoryInstance = new SubCategory();

        $index = 'id';

        $res = \Batch::update($categoryInstance, $data, $index);

        if ($res > 0) {
            return response()->json([
                "status" => 200,
                "message" => "Ordered Successfully! ",

            ]);
        } else {
            return response()->json([
                "status" => 500,
                "message" => "Somthing Went wrong! ",

            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            if ($request->has('status')) {
                SubCategory::where('id', $request->subcategory_id)->update(['status' => $request->status]);
            } elseif ($request->has('featured')) {
                SubCategory::where('id', $request->subcategory_id)->update(['featured' => $request->featured]);
            } else {
                SubCategory::where('id', $request->subcategory_id)->update(['popular' => $request->popular]);
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
