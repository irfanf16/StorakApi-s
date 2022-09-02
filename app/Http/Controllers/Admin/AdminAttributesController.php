<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ApiDataGenerate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Attribute;
use App\Models\Variant;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Brand;
use App\Models\Key;

class AdminAttributesController extends Controller
{
    use ApiDataGenerate;
    /*
    |================================================================
    | Get Listing of The All Attributes --
    |================================================================
    */


    public function index(Request $request)
    {
        try {

            $attributes = Attribute::query()
                                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                                    $query->where('title', 'LIKE', '%' . $request->search . "%");
                                     })->latest()
                                    ->paginate($request->datatable_length);
            return response()->json([
                'status'             => 200,
                'attributes'         => $attributes,
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

    public function countAttrib()
    {
      try {

        $attributes =   Attribute::all();
        $attributes_count          = count($attributes);
        $active_attributes_count   = $attributes->where('status',1)->count();
        $inactive_attributes_count = $attributes->where('status',0)->count();

        return response()->json([
            'status'             => 200,
            // 'attributes'         => $attributes,
            'attributes_count'   => $attributes_count,
            'active_attributes'  => $active_attributes_count,
            'inactive_attributes'=> $inactive_attributes_count,
        ]);
      }
      catch (\Exception $e) {

        ///throw $th;
        return response()->json([
            "status"    => 100,
            "message"   => "Sorry! Something Went Wrong.",
            "exceptions"=> $e->getMessage()
        ]);
    }
    }



    /*
    |================================================================
    | Show the form for creating a new Attribute.
    |================================================================
    */
    public function create()
    {
        $categories = Category::with(['subcategories', 'childcategories', 'brands'])->get();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        $attributes_count = count($attributes);
        $keys = Key::all();

        return response()->json([
            'status'     => 200,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'childcategories' => $childcategories,
            'brands' => $brands,
            'attributes' => $attributes,
            'keys'  => $keys,
            'attributes_count'  => $attributes_count

        ]);
    }



    /*
    |================================================================
    | Store a Newly Created Attribute in Storage.
    |================================================================
    */
    public function store(Request $request)
    {
        // return($request->all());
        $validator = Validator::make( $request->all(), [
            'title'       => 'bail|required|string|unique:attributes|max:100',
            'title_ar'       => 'bail|required|string|unique:attributes|max:100',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        try {
            $formData = [
                'title'  => $request->title,
                'slug'       => $this->createSlug('attributes',$request->title),
                'title_ar'  => $request->title_ar,
                'status' => $request->status == "on" ? 1 : 0,
            ];

            $attribute = new Attribute();
            $isSaved =  $attribute   = $attribute->create($formData);

            if(isset($request->subcategories)){
                $attribute->subcategories()->attach($request->subcategories);
            }

            if($request->keys){
                $attribute->keys()->attach($request->keys);
            }

            if($request->childcategories){
                $attribute->childcategories()->attach($request->childcategories);
            }

            if ($isSaved) {
                return response()->json([
                    "status"  => 200,
                    "message" => "Attribute is Added Successfully",
                ]);
            }

            else{
                return response()->json([
                    "status"  => 100,
                    "message" => "Sorry! Something Went Wrong",
                ]);
            }
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



    /*
    |================================================================
    | Display the specified resource.
    |================================================================
    */
    public function show($id)
    {
        try {
            $attribute = Attribute::where('id',$id)
                                  ->with(['subcategories', 'childcategories' , 'keys'])
                                  ->first();

            return response()->json([
                'status'    => 200,
                'attribute' => $attribute
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



    /*
    |================================================================
    | Show the form for editing the specified resource.
    |================================================================
    */
    public function edit($id)
    {
        try {
            $attribute = Attribute::where('id',$id)->with('childcategories','subcategories', 'keys')->first();
            $subcategories = SubCategory::orderBy('title' , 'ASC')->get();
            $keys = Key::orderBy('name' , 'ASC')->get();
            $childcategories = ChildCategory::orderBy('title' , 'ASC')->get();

            return response()->json([
                'status'    => 200,
                'attribute' => $attribute,
                'keys' => $keys,
                'subcategories' => $subcategories,
                'childcategories' => $childcategories
            ]);
        }
        catch (\Exception $e) {

            ///throw $th;
            return response()->json([
                "status"    => 100,
                "message"   => "Sorry! Something Went Wrong.",
                "exceptions"=> $e->getMessage()
            ]);
        }
    }



    /*
    |================================================================
    | Update the specified resource in storage.
    |================================================================
    */
    public function update(Request $request, $id)
    {
        // return($request->all());
        $validator = Validator::make( $request->all(), [
            'title'       => ['bail', 'required', 'string',Rule::unique('attributes')->ignore($id), 'max:100'],
            'title_ar'       => ['bail', 'required', 'string',Rule::unique('attributes')->ignore($id), 'max:100'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        try {
            $formData = [
                'title'      => $request->title,
//                'slug'       => $this->createSlug('categories',$request->title),
                'title_ar'      => $request->title_ar,
                'status'     => $request->status == "on" ? 1 : 0,
            ];

            $isUpdated  = Attribute::where('id', $id)->update($formData);

            $attribute = Attribute::where('id', $id)->first();

            if($request->subcategories){
                $attribute->subcategories()->sync($request->subcategories);
            }

            if($request->keys){
                $attribute->keys()->sync($request->keys);
            }

            if($request->childcategories){
                $attribute->childcategories()->sync($request->childcategories);
            }

            if ($isUpdated) {
                return response()->json([
                    'status'  => 200,
                    'message' => 'Attribute is Updated Successfully'
                ]);
            }

            else{
                return response()->json([
                    "status"  => 100,
                    "message" => "Sorry! Something Went Wrong",
                ]);
            }
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



    /*
    |================================================================
    | Remove The Specified Attribute From Storage.
    |================================================================
    */
    public function destroy($id)
    {
        try {
            $isDeleted = Attribute::where('id',$id)->delete();
            if ($isDeleted) {
                return response()->json([
                    "status"  => 200,
                    "message" => "Attribute is Deleted Successfully",
                ]);
            }
            return response()->json([
                "status"  => 100,
                "message" => "Something Went Wrong",
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

    public function statusChanged($id){
        $attribute = Attribute::where('id', $id)->first();
        if ($attribute){
            return response()->json([
                "status" => 100,
                "message" => "Something Went Wrong",
            ]);
        }
        if ($attribute->status){
            $attribute->status=0;
        }else{
            $attribute->status=1;
        }
        $attribute->save();

        return response()->json([
            "status" => 200,
            "message" => "Attribute Status Changed Successfully",
        ]);
    }

    public function changeStatus(Request $request)
    {
        try {

           $attribStatus  =  Attribute::where('id', $request->attribute_id)->update(['status' => $request->status]);

            return response()->json(['attribStatus' => $attribStatus, 'status' => 200,'success' => 'Status changed successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }

}
