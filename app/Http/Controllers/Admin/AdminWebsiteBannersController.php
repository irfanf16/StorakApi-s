<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\WebsiteBanner;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;

use App\Traits\ApiHelper;
class AdminWebsiteBannersController extends Controller
{
    use ApiHelper;
    
    /*
    |=================================================================
    | Display a listing of All Website Banners.
    |=================================================================
    */
    public function index()
    { 
        try {
            $banners          = WebsiteBanner::orderBy('order','asc')->get();
            $banners_count    = count($banners);
            $active_banners   = $banners->where('status',1)->count();
            $inactive_banners = $banners->where('status',0)->count();

            return response()->json([
                'status'          => 200,
                'banners'         => $banners,
                'banners_count'   => $banners_count,
                'active_banners'  => $active_banners,
                'inactive_banners'=> $inactive_banners,
            ]);

        } 
        catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status" => 100,
                "errors" => $th->getMessage()
            ]);
        }
    }



    /*
    |=================================================================
    | Create New Website Banner
    |=================================================================
    */
    public function create()
    {
        //
    }

    

    /*
    |=================================================================
    | Store a Newly Created Website Banner in Storage.
    |=================================================================
    */ 
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'title'       => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'image'       => 'required',
            'link'        => 'required|url',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        try {
            // WEBSITE BANNER-IMAGE -- SAVE IN STORAGE
            $image = $request->input('image');
            $image_name = ApiHelper::uploadFile($image , 'public' , 'banners/website' , false);

            $formData = [
                'title'       => $request->title,
                'description' => $request->description,
                'image'       => $image_name,
                'link'        => $request->link,
                'status'      => $request->status == "on" ? 1 : 0,
            ];

            // WEBSITE BANNER -- ORDER
            $banners_count = WebsiteBanner::count();
            $formData['order'] = $banners_count+1;

            $banner = new WebsiteBanner();
            $banner->create($formData);
            
            return response()->json([
                "status"  => 200,
                "message" => "Website banner is added successfully",
            ]);
        } 
        
        catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status" => 100,
                "errors" => $th->getMessage()
            ]);
        }

    }



    /*
    |============================================================
    | Display the specified resource.
    |============================================================
    */
    public function show($id)
    {
        //
    }



    /* 
    |============================================================
    | Show The Form For Editing The Specified Website Banner.
    |============================================================
    */
    public function edit($id)
    {
        try {
            $banner = WebsiteBanner::where('id',$id)->first();
            return response()->json([
                'status' => 200,
                'banner' => $banner
            ]);

        } 
        catch (\Throwable $th) {
            
            //throw $th;
            return response()->json([
                "status" => 100,
                "errors" => $th->getMessage()
            ]);
        }

    }



    /* 
    |=================================================================
    | Update The Specified Website Banner in Storage.
    |=================================================================
    */
    public function update(Request $request, $id)
    {
        $validator = Validator::make( $request->all(), [
            'title'       => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'link'        => 'required|url',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        try {
            $formData = [
                'title'       => $request->title,
                'description' => $request->description,
                'link'        => $request->link,
                'status'      => $request->status == "on" ? 1 : 0,
            ];

            // WEBSITE BANNER-IMAGE -- SAVE IN STORAGE
            if ($request->input('image')) {

                $image = $request->input('image');
                $image_name = ApiHelper::uploadFile($image , 'public' , 'banners/website' , false);

                $formData['image'] = $image_name;
            }

            WebsiteBanner::where('id', $id)->update($formData);
            
            return response()->json([
                "status"  => 200,
                "message" => "Website banner is updated successfully",
            ]);

        } 
        catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status" => 100,
                "errors" => $th->getMessage()
            ]);
        }    

    }



    /*
    |=======================================================================
    | Delete (Soft-Delete) the specified banner from storage. -- Single
    |=======================================================================
    */
    public function destroy($id)
    {
        try {
            $is_banner = WebsiteBanner::find($id);
            if ($is_banner) {

                $is_banner->delete();
                return response()->json([
                    "status"  => 200,
                    "message" => "Banner is deleted successfully",
                ]);
            }
            else{
                return response()->json([
                    "status"  => 404,
                    "message" => "No Record Found",
                ]);
            }
        } 
        catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status" => 100,
                "errors" => $th->getMessage()
            ]);
        }

    }



    /*
    |=======================================================================
    | Delete (Soft-Delete) the specified banners from storage. -- Multiple
    |=======================================================================
    */
    public function deleteMultipleBanners(Request $request)
    {
        try {
            WebsiteBanner::destroy($request->banner_id);
            return response()->json([
                'status' => 200,
                'message'=> "Selected banners are deleted successfully",
            ]);

        } 
        catch (\Throwable $th) {
            
            //throw $th;
            return response()->json([
                "status"  => 100,
                "message" => $th->getMessage()
            ]);
        }

    }



    /*
    |=======================================================================
    | Delete (Soft-Delete) all banners from storage -- delete all
    |=======================================================================
    */
    public function deleteAllBanners()
    {
        try {
            DB::table('website_banners')->delete();

            return response()->json([
                'status' => 200,
                'message'=> "All banners have been deleted successfully",
            ]);

        }
        catch (\Throwable $th) {
            
            //throw $th;
            return response()->json([
                "status"  => 100,
                "message" => $th->getMessage()
            ]);
        }
    }



    /*
    |=======================================================================
    | Show Listing of Archived (Soft-Deleted) Website Banners
    |=======================================================================
    */
    public function showArchiveBanners()
    {
        try {
            $banners = WebsiteBanner::onlyTrashed()
                                    ->orderBy('updated_at', 'ASC')
                                    ->get();

            return response()->json([
                'status'  => 200,
                'banners' => $banners,
            ]);

        } 
        catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status"   => 100,
                "message"  => "Sorry! Something Went Wrong.",
                "exception"=> $th
            ]);
        }
    }



    /*
    |=======================================================================
    | Restore Archieved (Soft-Deleted) Website Banners
    |=======================================================================
    */
    public function restoreBanner(Request $request)
    {
        try {
            $banner = WebsiteBanner::where("id", $request->id)
                                    ->withTrashed()
                                    ->first();
            $banner->restore();
            
            return response()->json([
                "status"  => 200,
                "message" => "Banner is restored successfully",
            ]);

        } 
        catch (\Throwable $th) {

            //throw $th;
            return response()->json([
                "status"   => 100,
                "message"  => "Sorry! Something Went Wrong.",
                "exception"=> $th
            ]);
        }

    }



    /*
    |=======================================================================
    | Update The Order/Priority Of Website Banners
    |=======================================================================
    */
    public function orderUpdate(Request $request)
    {
        try {
            $data = $request->all();

            $bannerInstance = new WebsiteBanner;
            $index = 'id';

            $res = \Batch::update($bannerInstance, $data, $index);

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
        
        catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status"   => 100,
                "message"  => "Sorry! Something Went Wrong.",
                "exception"=> $th
            ]);
        }
        

    }

}