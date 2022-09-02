<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

use App\Models\Partner;

class AdminPartnersController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index()
    { 
      try {
        $partners          = Partner::all();
        $partners_count    =count($partners);
        $active_partners   =  $partners->where('status',1)->count();
        $inactive_partners =  $partners->where('status',0)->count();

        return response()->json([
            'status'          => 200,
            'partners'         => $partners,
            'partners_count'   => $partners_count,
            'active_partners'  => $active_partners,
            'inactive_partners'=> $inactive_partners,
        ]);
      } 
      catch (\Exception$e) {
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
       //
    }

    

    /*
    |====================================================
    | Store a newly created resource in storage.
    |====================================================
    */ 
    public function store(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'title' => 'required|string|unique:partners|max:100',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'title'  => $request->title,
            'status' => $request->status == "on" ? 1 : 0,
        ];

        if ($request->image) {

            $image          = $request->image;
            $imageExtension = $image->extension();
            $currentTime    = time();
            $imageName      = $currentTime.'.'.$imageExtension;
            
            $image = Image::make($image->getRealPath());

            // ORIGIONAL
            $imagePath = public_path('/admin/images/partners/org');
            $imageSave = $image->save($imagePath.'/'.$imageName,100);

            $formData['image'] = $imageName;
        }

        $newPartner = new Partner();
        $isSaved    = $newPartner->create($formData);
        
        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Partner is Added Successfully",
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
        //
    }



    /* 
    |==========================================================
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($id)
    {
        $partner = Partner::where('id',$id)->first();
    
        return response()->json([
            'status'  => 200,
            'partner' => $partner
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
            'title' => ['bail', 'required', 'string', Rule::unique('partners')->ignore($id), 'max:100'],
            'image' => ['bail', 'image', 'mimes:jpeg,png,jpg'. "max:2048"],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'title'  => $request->title,
            'status' => $request->status == "on" ? 1 : 0,
        ];

        if ($request->image) {
            
            $partner = Partner::findOrFail($id);
            
            // UNLINK IMAGES
            if ($partner->image != NULL && file_exists(public_path() . '/admin/images/partners/org/' . $partner->image)) {
                unlink(public_path() . '/admin/images/partners/org/' . $partner->image);
            }

            $image          = $request->image;
            $imageExtension = $image->extension();
            $currentTime    = time();
            $imageName      = $currentTime.'.'.$imageExtension;
            
            $image = Image::make($image->getRealPath());

            // ORIGIONAL
            $imagePath   = public_path('/admin/images/partners/org');
            $imageSave   = $image->save($imagePath.'/'.$imageName,60);

            $formData['image'] = $imageName;
        }
        
        $isUpdated = Partner::where('id', $id)->update($formData);
        
        if ($isUpdated) {
            return response()->json([
                'status'  => 200,
                'message' => 'Partner Records Are Updated Successfully'
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
        $partner = Partner::findOrFail($id);
            
        if ($partner) {

            if ($partner->image != NULL && file_exists(public_path() . '/admin/images/partners/org/' . $partner->image)) {
                unlink(public_path() . '/admin/images/partners/org/' . $partner->image);
            }

            $partner = Partner::findOrFail($id)->delete();

            return response()->json([
                "status"  => 200,
                "message" => "Partner is Deleted Successfully",
            ]);
        }

        return response()->json([
            "status"  => 100,
            "message" => "Something Went Wrong",
        ]);

    }
}