<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

use App\Models\MobileCover;
use App\Traits\ApiHelper;

class AdminMobileCoversController extends Controller
{
    use ApiHelper;
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index()
    {
        $covers          = MobileCover::all();
        $covers_count    = MobileCover::count();
        $active_covers   = MobileCover::where('status',1)->count();
        $inactive_covers = MobileCover::where('status',0)->count();

        return response()->json([
            'status'         => 200,
            'covers'         => $covers,
            'covers_count'   => $covers_count,
            'active_covers'  => $active_covers,
            'inactive_covers'=> $inactive_covers,
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
        $formData = [
            'status' => $request->status == "on" ? 1 : 0,
        ];

        if ($request->image) {

            // $validator = \Validator::make( $request->all(), [
            //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);

            // if($validator->fails()){
            //     return response()->json([
            //         'status' => 100,
            //         'errors' => $validator->messages()->all()
            //     ]);
            // }

            $imageName = self::uploadFile($request->image , 'public' , 'banners/mobile' , true);

            $formData['image'] = $imageName;
        }

        $cover   = new MobileCover();
        $isSaved = $cover->create($formData);

        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Mobile Cover Image is Added Successfully",
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
        $cover = MobileCover::where('id',$id)->first();

        return response()->json([
            'status' => 200,
            'cover'  => $cover
        ]);
    }



    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    {
        $formData = [
            'status' => $request->status == "on" ? 1 : 0,
        ];

        if ($request->image) {

            // $validator = \Validator::make( $request->all(), [
            //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);

            // if($validator->fails()){
            //     return response()->json([
            //         'status' => 100,
            //         'errors' => $validator->messages()->all()
            //     ]);
            // }

            // $cover = MobileCover::findOrFail($id);

            // // UNLINK IMAGES
            // if ($cover->image != NULL && file_exists(public_path() . '/admin/images/banners/mobile/org/' . $cover->image)) {
            //     unlink(public_path() . '/admin/images/banners/mobile/org/' . $cover->image);
            // }

            // if ($cover->image != NULL && file_exists(public_path() . '/admin/images/banners/mobile/sm/' . $cover->image)) {
            //     unlink(public_path() . '/admin/images/banners/mobile/sm/' . $cover->image);
            // }

            // $image          = $request->image;
            // $imageExtension = $image->extension();
            // $currentTime    = time();
            // $imageName      = $currentTime.'.'.$imageExtension;

            // $image = Image::make($image->getRealPath());

            // // ORIGIONAL
            // $imagePath   = public_path('/admin/images/banners/mobile/org');
            // $imageSave   = $image->save($imagePath.'/'.$imageName,100);

            // // SMALL
            // $imagePath   = public_path('/admin/images/banners/mobile/sm');
            // $imageResize = $image->resize(200, 100);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,60);

            $imageName = self::uploadFile($request->image , 'public' , 'banners/mobile' , true);


            $formData['image'] = $imageName;
        }


        $isUpdated = MobileCover::where('id', $id)->update($formData);

        if ($isUpdated) {
            return response()->json([
                'status'  => 200,
                'message' => 'Mobile Cover Image is Updated Successfully'
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
        $cover = MobileCover::findOrFail($id);

        if ($cover) {

            if ($cover->image != NULL && file_exists(public_path() . '/admin/images/banners/mobile/org/' . $cover->image)) {
                unlink(public_path() . '/admin/images/banners/mobile/org/' . $cover->image);
            }

            if ($cover->image != NULL && file_exists(public_path() . '/admin/images/banners/mobile/sm/' . $cover->image)) {
                    unlink(public_path() . '/admin/images/banners/mobile/sm/' . $cover->image);
                }

            $cover = MobileCover::findOrFail($id)->delete();

            return response()->json([
                "status"  => 200,
                "message" => "Mobile cover Image is Deleted Successfully",
            ]);
        }

        return response()->json([
            "status"  => 100,
            "message" => "Something Went Wrong",
        ]);

    }
}
