<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

use App\Models\City;

class AdminCitiesController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index()
    { 
        $cities                = City::all();
        $cities_count          = City::count();
        $active_cities_count   = City::where('status',1)->count();
        $inactive_cities_count = City::where('status',0)->count();

        return response()->json([
            'status'         => 200,
            'cities'         => $cities,
            'cities_count'   => $cities_count,
            'active_cities'  => $active_cities_count,
            'inactive_cities'=> $inactive_cities_count,
        ]);
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
            'name'        => ['bail', 'required', 'string','unique:cities', 'max:100'],
            'description' => ['bail', 'max:500'],
        ]);

        $formData = [
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->status == "on" ? 1 : 0,
        ];

        // IF STORE-REQUEST HAS IMAGE
        if ($request->image) {

            $validator = \Validator::make( $request->all(), [
                'image' => ['bail', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->messages()->all()
                ]);
            }

            $image          = $request->image;
            $imageExtension = $image->extension();
            $currentTime    = time();
            $imageName      = $currentTime.'.'.$imageExtension;

            $image       = Image::make($image->getRealPath());
            $imagePath   = public_path('/admin/images/locations/sm');
            $imageResize = $image->resize(100, 100);
            $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            $imagePath   = public_path('/admin/images/locations/md');
            $imageResize = $image->resize(200, 200);
            $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            $imagePath   = public_path('/admin/images/locations/lg');
            $imageResize = $image->resize(400, 400);
            $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);
            
            $formData['image'] = $imageName;
        }

        $city = new City();
        $isSaved  = $city->create($formData);
        
        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "City is Added Successfully",
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
        $city = City::where('id',$id)->first();
    
        return response()->json([
            'status'=> 200,
            'city'  => $city
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
            'name'       => ['bail', 'required', 'string',Rule::unique('cities')->ignore($id), 'max:100'],
            'description' => ['bail', 'max:500'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'name'       => $request->name,
            'description'=> $request->description,
            'status'     => $request->status == "on" ? 1 : 0,
        ];

        // IF UPDATE-REQUEST HAS IMAGE
        if ($request->image) {

            $validator = \Validator::make( $request->all(), [
                'image' => ['bail', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->messages()->all()
                ]);
            }
            
            $city = City::findOrFail($id);
            
            if ($city->image != NULL && file_exists(public_path() . '/admin/images/locations/sm/' . $city->image)) {
                unlink(public_path() . '/admin/images/locations/sm/' . $city->image);
            }

            if ($city->image != NULL && file_exists(public_path() . '/admin/images/locations/md/' . $city->image)) {
                unlink(public_path() . '/admin/images/locations/md/' . $city->image);
            }

            if ($city->image != NULL && file_exists(public_path() . '/admin/images/locations/lg/' . $city->image)) {
                unlink(public_path() . '/admin/images/locations/lg/' . $city->image);
            }

            $image          = $request->image;
            $imageExtension = $image->extension();
            $currentTime    = time();
            $imageName      = $currentTime.'.'.$imageExtension;
            
            $image       = Image::make($image->getRealPath());
            $imagePath   = public_path('/admin/images/locations/sm');
            $imageResize = $image->resize(100, 100);
            $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            $imagePath   = public_path('/admin/images/locations/md');
            $imageResize = $image->resize(200, 200);
            $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            $imagePath   = public_path('/admin/images/locations/lg');
            $imageResize = $image->resize(400, 400);
            $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            $formData['image'] = $imageName;
        }
        
        
        $isUpdated = City::where('id', $id)->update($formData);
        
        if ($isUpdated) {
            return response()->json([
                'status'  => 200,
                'message' => 'City Records Are Updated Successfully'
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
        // $stores_count = Store::where('city_id',$id)->count();
        $city = City::findOrFail($id);
        
        $stores_count = 0;

        if ($stores_count < 1) {
            
            if ($city->image != NULL && file_exists(public_path() . '/admin/images/locations/sm/' . $city->image)) {
                unlink(public_path() . '/admin/images/locations/sm/' . $city->image);
            }

            if ($city->image != NULL && file_exists(public_path() . '/admin/images/locations/md/' . $city->image)) {
                unlink(public_path() . '/admin/images/locations/md/' . $city->image);
            }

            if ($city->image != NULL && file_exists(public_path() . '/admin/images/locations/lg/' . $city->image)) {
                unlink(public_path() . '/admin/images/locations/lg/' . $city->image);
            }

            $isDeleted = City::where('id',$id)->delete();
            
            if ($isDeleted) {
                
                return response()->json([
                    "status"  => 200,
                    "message" => "City is Deleted Successfully",
                ]);
            }

            return response()->json([
                "status"  => 100,
                "message" => "Something Went Wrong",
            ]);
        }

        else{
            return response()->json([
                "status"  => 100,
                "message" => "You cannot delete this City as it is linked with some Stores.",
            ]);
        }
    }
}