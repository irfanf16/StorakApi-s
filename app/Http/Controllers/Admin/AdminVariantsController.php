<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminVariantsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
     */
    public function index()
    {
        try {
            $variants = Variant::with('attribute:id,title')->get();
            $variants_count = count($variants);
            $active_variants_count = $variants->where('status', 1)->count();
            $inactive_variants_count = $variants->where('status', 0)->count();

            return response()->json([
                'status' => 200,
                'variants' => $variants,
                'variants_count' => $variants_count,
                'active_variants' => $active_variants_count,
                'inactive_variants' => $inactive_variants_count,
            ]);
        } catch (\Exception$e) {
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
        $attributes = Attribute::where('status', 1)
            ->select('id', 'title')
            ->get();

        return response()->json([
            'status' => 200,
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
        $validator = \Validator::make($request->all(), [
            'attribute_id' => 'required|integer',
            'title' => 'required|string|unique:variants|max:100',
            'description' => 'max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all(),
            ]);
        }

        $formData = [
            'attribute_id' => $request->attribute_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status == "on" ? 1 : 0,
        ];

        $variant = new Variant();
        $isSaved = $variant->create($formData);

        if ($isSaved) {
            return response()->json([
                "status" => 200,
                "message" => "Variant is Added Successfully",
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
        $variant = Variant::where('id', $id)->first();
        $attributes = Attribute::all();

        return response()->json([
            'status' => 200,
            'variant' => $variant,
            'attributes' => $attributes,
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
            'attribute_id' => ['bail', 'required', 'integer'],
            'title' => ['bail', 'required', 'string', Rule::unique('variants')->ignore($id), 'max:100'],
            'description' => ['bail', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all(),
            ]);
        }

        $formData = [
            'attribute_id' => $request->attribute_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status == "on" ? 1 : 0,
        ];

        $isUpdated = Variant::where('id', $id)->update($formData);

        if ($isUpdated) {
            return response()->json([
                'status' => 200,
                'message' => 'Variant is Updated Successfully',
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
        // $products_count = Products::where('variant_id',$id)->count();
        $products_count = 0;

        if ($products_count < 1) {

            $isDeleted = Variant::where('id', $id)->delete();

            if ($isDeleted) {

                return response()->json([
                    "status" => 200,
                    "message" => "Variant is Deleted Successfully",
                ]);
            }

            return response()->json([
                "status" => 100,
                "message" => "Something Went Wrong",
            ]);
        } else {
            return response()->json([
                "status" => 100,
                "message" => "You cannot delete this Variant as it is linked with some products.",
            ]);
        }
    }
}
