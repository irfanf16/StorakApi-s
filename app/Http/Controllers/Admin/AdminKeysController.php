<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Key;
use Illuminate\Http\Request;

class AdminKeysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            
        $keys = Key::query()
        ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . "%");
        })->latest()
        ->paginate($request->datatable_length);
    // $attributes_count          = Attribute::count();
    // $active_attributes_count   = Attribute::where('status',1)->count();
    // $inactive_attributes_count = Attribute::where('status',0)->count();

    return response()->json([
        'status' => 200,
        'keys' => $keys,
        // 'attributes_count'   => $attributes_count,
        // 'active_attributes'  => $active_attributes_count,
        // 'inactive_attributes'=> $inactive_attributes_count,
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::all();

        return response([
            'status' => 200,
            'attributes' => $attributes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator = \Validator::make($request->all(), [
            'name' => 'bail|required|string|unique:keys|max:100',
            'name_ar' => 'bail|required|string|unique:keys|max:100',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'name' => $request->name,
            'name_ar' => $request->name_ar,

            'status' => $request->status == "on" ? 1 : 0,
        ];

        $key = new Key();
        $isSaved = $key = $key->create($formData);

        // return $key;


        if (isset($request->attributes)) {

            $key->attributes()->attach($request->input('attributes'));
        }


        if ($isSaved) {
            return response()->json([
                "status" => 200,
                "message" => "key is Added Successfully",
            ]);

        } else {
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong",
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $key = Key::where('id', $id)->orderBy('name', 'ASC')->with('attributes')->first();
        return response()->json([
            "status" => 200,
            "key" => $key
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $key = Key::where('id', $id)->orderBy('name', 'ASC')->with('attributes')->first();
        $attributes = Attribute::orderBy('title', 'ASC')->get();
        
        return response()->json([
            "status" => 200,
            "attributes" => $attributes,
            "key" => $key
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = \Validator::make($request->all(), [
            'name' => 'bail|required|string|max:100',
            'name_ar' => 'bail|required|string|max:100',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'name' => $request->name,
            'name_ar' => $request->name_ar,

            'status' => $request->status == "on" ? 1 : 0,
        ];

        $key = new Key();
        $isSaved = $key->where('id', $id)->update($formData);
        $key = Key::where('id', $id)->first();
        // return $key;


        if (isset($request->attributes)) {

            $key->attributes()->sync($request->input('attributes'));
        }


        if ($isSaved) {
            return response()->json([
                "status" => 200,
                "message" => "key is updated Successfully",
            ]);

        } else {
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDeleted = Key::where('id', $id)->delete();

        if ($isDeleted) {

            return response()->json([
                "status" => 200,
                "message" => "Key is Deleted Successfully",
            ]);
        }

        return response()->json([
            "status" => 100,
            "message" => "Something Went Wrong",
        ]);
    }
    public function changeStatus(Request $request)
    {
        try {
         
           $keyStatus  =  Key::where('id', $request->key_id)->update(['status' => $request->status]);
            
            return response()->json(['keyStatus' > $keyStatus, 'status' => 200,'success' => 'Status changed successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }
}
