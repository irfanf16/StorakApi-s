<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ApiDataGenerate;
use App\Traits\ApiHelper;
use Illuminate\Http\Request;
use Image;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use App\Models\Brand;
use App\Models\Attribute;

class AdminChildcategoriesController extends Controller
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

            $childcategories = ChildCategory::query()
                                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                                    $query->where('title', 'LIKE', '%' . $request->search . "%");
                                     })->withCount('products')->with('category:id,title','subcategory:id,title')->latest()
                                    ->paginate($request->datatable_length);
            return response()->json([
                'status'             => 200,
                'childcategories'         => $childcategories,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage(),
            ]);
        }

    }

    public function countChild()
    {
        try {
            $childcategories = ChildCategory::with(['category','subcategory'])
                ->orderBy('order', 'ASC')
                ->get();

            $childcategories_count = count($childcategories);
            $active_childcategories_count = $childcategories->where('status', 1)->count();
            $inactive_childcategories_count = $childcategories->where('status', 0)->count();
            $featured_childcategories_count = $childcategories->where('featured', 1)->count();

            return response()->json([
                'status' => 200,
                // 'childcategories' => $childcategories,
                'childcategories_count' => $childcategories_count,
                'active_childcategories' => $active_childcategories_count,
                'inactive_childcategories' => $inactive_childcategories_count,
                'featured_childcategories' => $featured_childcategories_count,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage(),
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
        $categories = Category::select('id', 'title')->where('status', 1)->get();
        $brands = Brand::all();
        $attributes = Attribute::all();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::all();

        return response()->json([
            'status' => 200,
            'categories' => $categories,
            'brands' => $brands,
            'attributes' => $attributes,
            'subcategories' => $subcategories,
            'childcategories' => $childcategories
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
        $validator = \Validator::make($request->all(), [
            'category_id' => ['bail', 'required', 'integer'],
            'subcategory_id' => ['bail', 'required', 'integer'],
            'title' => ['bail', 'required', 'string', 'max:100'],
            'title_ar' => ['bail', 'required', 'string', 'max:100'],
            'description' => ['bail', 'max:500'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all(),
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
            'subcategory_id' => $request->subcategory_id,
            'title' => $request->title,
            'slug'       => $this->createSlug('child_categories',$request->title),
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'featured' => $request->featured == "on" ? 1 : 0,
            'status' => $request->status == "on" ? 1 : 0,
        ];

        // IF STORE-REQUEST HAS IMAGE
        if ($request->image) {

            // $image          = $request->image;
            // $imageExtension = $image->extension();
            // $currentTime    = time();
            // $imageName      = $currentTime.'.'.$imageExtension;

            // // SMALL IMAGES (100X100)
            // $image       = Image::make($image->getRealPath());
            // $imagePath   = public_path('/admin/images/childcategories/sm');
            // $imageResize = $image->resize(100, 100);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            // // MEDIUM IMAGES (200X200)
            // $imagePath   = public_path('/admin/images/childcategories/md');
            // $imageResize = $image->resize(200, 200);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            // // LARGE IMAGES (400X400)
            // $imagePath   = public_path('/admin/images/childcategories/lg');
            // $imageResize = $image->resize(400, 400);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            // INSERT THIS IMAGE INTO FORMDATA ARRAY
            $imageName = self::uploadFile($request->image, 'public', 'childcategories/image', true);
            $formData['image'] = $imageName;
        }

        // CREATE NEW OBJECT OF CATEGORY
        $childcategory = new ChildCategory();
        $childcategory_count = ChildCategory::count();
        $formData['order'] = $childcategory_count + 1;
        $isSaved = $childcategory = $childcategory->create($formData);

        if ($request->brands) {
            $attr = json_decode($request->input('brands'));
            $childcategory->brands()->attach($attr);
        }

        if ($request->attributes) {
            $attr = json_decode($request->input('attributes'));
            $childcategory->attributes()->attach($attr);
        }

        if ($request->sku_attributes) {
            $attr = json_decode($request->input('sku_attributes'));
            $childcategory->sku_attributes()->attach($attr);
        }

        if ($isSaved) {
            return response()->json([
                "status" => 200,
                "message" => "Childcategory is Added Successfully",
            ]);

        } else {
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong",
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
        //
    }

    /*
    |==========================================================
    | Show the form for editing the specified resource.
    |==========================================================
     */
    public function edit($id)
    {
        $childcategory = ChildCategory::where('id', $id)->with('brands', 'attributes', 'sku_attributes')->first();
        $categories = Category::select('id', 'title')->get();
        $brands = Brand::select('id', 'name')->get();
        $attributes = Attribute::select('id', 'title')->get();
        $subcategories = SubCategory::where('category_id', $childcategory->category_id)
            ->select('id', 'title')
            ->get();

        return response()->json([
            'status' => 200,
            'childcategory' => $childcategory,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands'  => $brands,
            'attributes'  => $attributes
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
            'subcategory_id' => ['bail', 'required', 'integer'],
            'title' => ['bail', 'required', 'string', 'max:100'],
            'title_ar' => ['bail', 'required', 'string', 'max:100'],
            'description' => ['bail', 'max:500'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all(),
            ]);
        }

        // // IF REQUEST HAS IMAGE, VALIDATE IT
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
            'subcategory_id' => $request->subcategory_id,
            'title' => $request->title,
//            'slug'       => $this->createSlug('categories',$request->title),
            'title_ar' => $request->title_ar,
            'description' => $request->description,
            'featured' => $request->featured == "on" ? 1 : 0,
            'status' => $request->status == "on" ? 1 : 0,
        ];

        // IF UPDATE-REQUEST HAS IMAGE
        if ($request->image) {

            $childcategory = ChildCategory::findOrFail($id);

            // // REMOVE EXISTING IMAGE FROM PUBLIC FOLDER IF IT EXISTS (100X100)
            // if ($childcategory->image != NULL && file_exists(public_path() . '/admin/images/childcategories/sm/' . $childcategory->image)) {
            //     unlink(public_path() . '/admin/images/childcategories/sm/' . $childcategory->image);
            // }

            // // REMOVE EXISTING IMAGE FROM PUBLIC FOLDER IF IT EXISTS (200X200)
            // if ($childcategory->image != NULL && file_exists(public_path() . '/admin/images/childcategories/md/' . $childcategory->image)) {
            //     unlink(public_path() . '/admin/images/childcategories/md/' . $childcategory->image);
            // }

            // // REMOVE EXISTING IMAGE FROM PUBLIC FOLDER IF IT EXISTS (400X400)
            // if ($childcategory->image != NULL && file_exists(public_path() . '/admin/images/childcategories/lg/' . $childcategory->image)) {
            //     unlink(public_path() . '/admin/images/childcategories/lg/' . $childcategory->image);
            // }

            // // READ NEW IMAGE
            // $image          = $request->image;
            // $imageExtension = $image->extension();
            // $currentTime    = time();
            // $imageName      = $currentTime.'.'.$imageExtension;

            // // SMALL IMAGES (100X100)
            // $image       = Image::make($image->getRealPath());
            // $imagePath   = public_path('/admin/images/childcategories/sm');
            // $imageResize = $image->resize(100, 100);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            // // MEDIUM IMAGES (200X200)
            // $imagePath   = public_path('/admin/images/childcategories/md');
            // $imageResize = $image->resize(200, 200);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            // // LARGE IMAGES (400X400)
            // $imagePath   = public_path('/admin/images/childcategories/lg');
            // $imageResize = $image->resize(400, 400);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            // INSERT THIS IMAGE INTO FORMDATA ARRAY
            $imageName = self::uploadFile($request->image, 'public', 'childcategories/image', true);

            $formData['image'] = $imageName;
        }

        $isUpdated = ChildCategory::where('id', $id)->update($formData);
        $childcategory = ChildCategory::where('id', $id)->first();
        if ($request->brands) {
            $attr = json_decode($request->input('brands'));
            $childcategory->brands()->sync($attr);
        }
        if ($request->attributes) {
            $attr = json_decode($request->input('attributes'));
            $childcategory->attributes()->sync($attr);
        }

        if ($request->sku_attributes) {
            $attr = json_decode($request->input('sku_attributes'));
            $childcategory->sku_attributes()->sync($attr);
        }

        if ($isUpdated) {
            return response()->json([
                'status' => 200,
                'message' => 'Childcategory Records Are Updated Successfully',
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
        $products_count = Product::where('childcategory_id', $id)->count();
        $childcategory = ChildCategory::findOrFail($id);

        if ($childcategory) {

            // // REMOVE EXISTING IMAGE FROM PUBLIC FOLDER IF IT EXISTS (100X100)
            // if ($childcategory->image != NULL && file_exists(public_path() . '/admin/images/childcategories/sm/' . $childcategory->image)) {
            //     unlink(public_path() . '/admin/images/childcategories/sm/' . $childcategory->image);
            // }

            // // REMOVE EXISTING IMAGE FROM PUBLIC FOLDER IF IT EXISTS (200X200)
            // if ($childcategory->image != NULL && file_exists(public_path() . '/admin/images/childcategories/md/' . $childcategory->image)) {
            //     unlink(public_path() . '/admin/images/childcategories/md/' . $childcategory->image);
            // }

            // // REMOVE EXISTING IMAGE FROM PUBLIC FOLDER IF IT EXISTS (400X400)
            // if ($childcategory->image != NULL && file_exists(public_path() . '/admin/images/childcategories/lg/' . $childcategory->image)) {
            //     unlink(public_path() . '/admin/images/childcategories/lg/' . $childcategory->image);
            // }

            $isDeleted = ChildCategory::where('id', $id)->delete();

            if ($isDeleted) {

                return response()->json([
                    "status" => 200,
                    "message" => "Childcategory is Deleted Successfully",
                ]);
            }

            return response()->json([
                "status" => 100,
                "message" => "Something Went Wrong",
            ]);
        } else {
            return response()->json([
                "status" => 100,
                "message" => "Child Category Not Found!",
            ]);
        }
    }

    public function showArchive()
    {

        $childCategory = ChildCategory::onlyTrashed()->orderBy('updated_at', 'ASC')->get();

        return response()->json([
            'status' => 200,
            'childcategories' => $childCategory,

        ]);

    }

    public function restoreCategory(Request $request)
    {
        try {
            $childCategory = ChildCategory::where("id", $request->id)->withTrashed()->first();
            // return $subCategory;/

            if ($childCategory) {
                $childCategory->restore();
                $childcategory_count = ChildCategory::count();
                $childCategory->order = $childcategory_count;
                $childCategory->save();
                return response()->json([
                    "status" => 200,
                    "message" => "Restored Successfully! ",

                ]);
            } else {
                return response()->json([
                    "status" => 404,
                    "message" => "Child Category Not Found ! ",

                ]);
            }

        } catch (\Throwable$th) {
            //throw $th;
            return response()->json([
                "status" => 500,
                "message" => "Sorry! Something Went Wrong.",
                "log" => $th,
            ]);
        }

    }

    public function orderUpdate(Request $request)
    {
        $values = [];
        $data = $request->all();

        $categoryInstance = new ChildCategory();

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
                ChildCategory::where('id', $request->child_id)->update(['status' => $request->status]);
            } elseif($request->has('featured')) {
                ChildCategory::where('id', $request->child_id)->update(['featured' => $request->featured]);
            }else{
                ChildCategory::where('id', $request->child_id)->update(['popular' => $request->popular]);
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
