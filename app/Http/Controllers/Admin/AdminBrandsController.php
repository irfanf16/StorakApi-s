<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute as ModelsAttribute;
use App\Traits\ApiDataGenerate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Traits\ApiHelper;


class AdminBrandsController extends Controller
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

            $brands = Brand::query()
                                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                                    $query->where('name', 'LIKE', '%' . $request->search . "%");
                                     })->latest()
                                    ->paginate($request->datatable_length);
            return response()->json([
                'status'             => 200,
                'brands'         => $brands,
            ]);
        }
        catch (\Throwable $th) {

            ///throw $th;
            return response()->json([
                "status"    => 100,
                "message"   => "Sorry! Something Went Wrong.",
                "exceptions"=> $th
            ]);
        }
    }

    public function countBrand()
    {
        try {
            $brands          = Brand::orderBy('name')->with('categories')->get();
            $brands_count    = count($brands );
            $active_brands   = $brands->where('status',1)->count();
            $inactive_brands = $brands->where('status',0)->count();

            return response()->json([
                'status'         => 200,
                // 'brands'         => $brands,
                'brands_count'   => $brands_count,
                'active_brands'  => $active_brands,
                'inactive_brands'=> $inactive_brands,
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

    /*
    |====================================================
    | Store a newly created resource in storage.
    |====================================================
    */
    public function store(Request $request)
    {
        // return $request->all();
        $validator = \Validator::make( $request->all(), [
            // 'category_id' => ['bail', 'required', 'integer'],
            'name'        => ['bail', 'required', 'string', 'unique:brands', 'max:100'],
            'name_ar'        => ['bail', 'required', 'string', 'unique:brands', 'max:100'],
            'description' => ['bail', 'max:1000'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'name'        => $request->name,
            'slug'       => $this->createSlug('brands',$request->title),
            'name_ar'        => $request->name_ar,
            'description' => $request->description,
            'featured'    => $request->featured == "on" ? 1 : 0,
            'status'      => $request->status == "on" ? 1 : 0,
        ];

        if ($request->logo_image) {




            $imageName = ApiHelper::uploadFile($request->logo_image , 'public' , 'brands/logo' , true );

            $formData['logo_image'] = $imageName;
        }

        if ($request->cover_image) {

            $imageName = ApiHelper::uploadFile($request->cover_image , 'public' , 'brands/cover' , true );


            $formData['cover_image'] = $imageName;
        }

        $brand   = new Brand();
        $isSaved  = $brand = $brand->create($formData);


        if($request->categories)
        {
            $brand->categories()->attach($request->categories);
        }

        if($request->subcategories)
        {
            $brand->subcategories()->attach($request->subcategories);
        }

        if($request->childcategories)
        {
            $brand->childcategories()->attach($request->childcategories);
        }


        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Brand is Added Successfully",
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
    |==================================================
    | Display the specified resource.
    |==================================================
    */
    public function show($id)
    {
        $brand = Brand::where('id' ,$id)->with('categories' , 'subcategories' , 'childcategories')->first();
        if($brand){
            return response()->json([
                "status" => 200,
                "brand" => $brand
            ]);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "Brand Not Found!"
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
        $brand      = Brand::where('id',$id)->with('categories' , 'subcategories' , 'childcategories')->first();
        $categories = Category::orderBy('title' , 'ASC')->get();
        $subcategories = SubCategory::orderBy('title' , 'ASC')->get();
        $childcategories = ChildCategory::orderBy('title' , 'ASC')->get();

        return response()->json([
            'status'     => 200,
            'brand'      => $brand,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'childcategories' => $childcategories
        ]);
    }



    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $validator = \Validator::make( $request->all(), [
            // 'category_id' => ['bail', 'required', 'integer'],
            'name'=> ['bail', 'required', 'string', Rule::unique('brands')->ignore($id), 'max:100'],
            'name_ar'=> ['bail', 'required', 'string', Rule::unique('brands')->ignore($id), 'max:100'],
            'description' => ['bail', 'max:1000'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            // 'category_id' => $request->category->id,
            'name'        => $request->name,
//            'slug'       => $this->createSlug('brands',$request->title),
            'name_ar'        => $request->name_ar,
            'description' => $request->description,
            'featured'    => $request->featured == "on" ? 1 : 0,
            'status'      => $request->status == "on" ? 1 : 0,
        ];

        if ($request->logo_image) {



            $brand = Brand::findOrFail($id);



            $imageName = ApiHelper::uploadFile($request->logo_image , 'public' , 'brands/logo' , true );


            $formData['logo_image'] = $imageName;
        }

        if ($request->cover_image) {



            $brand = Brand::findOrFail($id);



            $imageName = ApiHelper::uploadFile($request->cover_image , 'public' , 'brands/cover' , true );


            $formData['cover_image'] = $imageName;
        }

        $isUpdated = Brand::where('id', $id)->update($formData);

        $brand   = Brand::where('id' , $id)->first();


        if($request->categories){



            $brand->categories()->sync($request->categories);

        }


        if($request->subcategories){



            $brand->subcategories()->sync($request->subcategories);

        }

        if($request->childcategories){


            $brand->childcategories()->sync($request->childcategories);

        }

        $brand->save();



        if ($isUpdated) {
            return response()->json([
                "status"  => 200,
                "message" => "Brand is Updated Successfully",
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
        $brand = Brand::findOrFail($id);

        if ($brand) {


            $isDeleted = Brand::where('id',$id)->delete();

            if ($isDeleted) {

                return response()->json([
                    "status"  => 200,
                    "message" => "Brand is Deleted Successfully",
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
                "message" => "Brand Not Found !",
            ]);
        }
    }


    public function showArchive(){

        $brands  = Brand::onlyTrashed()->orderBy('updated_at' , 'ASC')->get();


        return response()->json([
            'status'             => 200,
            'brands'         => $brands,

        ]);

    }

    public function restoreCategory(Request $request){
        try {
            $brand = Brand::where("id" , $request->id)->withTrashed()->first();

            // dd($category);

            if($brand){
                $brand->restore();
                return response()->json([
                    "status"  => 200,
                    "message" => "Restored Successfully! ",

                ]);
            }
            else{
                return response()->json([
                    "status"  => 404,
                    "message" => "Brand Not Found ! ",

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

    public function changeStatus(Request $request)
    {
        try {
            if ($request->has('status')) {
                Brand::where('id', $request->brand_id)->update(['status' => $request->status]);
            } else {
                Brand::where('id', $request->brand_id)->update(['featured' => $request->featured]);
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
