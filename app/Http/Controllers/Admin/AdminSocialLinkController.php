<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use App\Traits\ApiHelper;
use Illuminate\Support\Facades\Storage;

class AdminSocialLinkController extends Controller
{
    use ApiHelper;

    public function index()
    {
        $socialLinks = SocialLink::all();
        return response([
            'status' => 200,
            'socialLinks' => $socialLinks
        ]);
    }

    public function store(Request $request)
    {
     try {
           $request->validate([
            'title' => 'required',
            'logo' => 'required'
        ]);

        $input['title'] = $request->title;
        $input['status'] = $request->status ? 1 : 0;
        if ($request->logo) {

            $imageName = self::uploadFile($request->logo , 'public' , 'social_links');
            $input['logo'] = $imageName;
        }
       $social =  SocialLink::create($input);
       return response([
        'status' => 200,
        'social' => $social
    ]);
     } catch (\Exception $e) {

        return response()->json([
            'message' => $e->getMessage()
        ]);
     }
    }

    public function edit($id)
    {
        $social = SocialLink::find($id);
        return response([
            'status' => 200,
            'social' => $social
        ]);
    }

    public function update(Request $request, $id)
    {
        $social = SocialLink::find($id);
        $social->title = $request->title;
        $social->status = $request->status ? 1 : 0;
        if($request->logo)
        {
            $imageName = self::uploadFile($request->logo , 'public' , 'social_links');
            $social->logo = $imageName;
        }

        $social->save();

        return response()->json([
            'status' => 200,
            'message' => 'Social link updated successfully'
        ]);
    }
     
    public function destroy($id)
    {
        $social = SocialLink::find($id);
        $social->delete();
        return response([
            'status' => 200,
            'message' => 'Social Link Deleted',
        ]);
    }
    
}
