<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class AdminAppSettingController extends Controller
{
    
    public function index()
    {
        try {
            $appsettings = AppSetting::all();
        return response()->json([
            'status' => 200,
            'appsettings' => $appsettings
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $appsetting = AppSetting::find($id);
        return response()->json([
            'status' => 200,
            'appsetting' => $appsetting
        ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {

        // return response()->json([
        //     'test' => $request->shortcode,
        // ]);

     try {
        $setting = AppSetting::find($id);
        $setting->update([
            'shortcode' => $request->shortcode,
            'description' => $request->description,
            'value2' => $request->status ? 1 : 0 
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'App Setting Updated Successfully'
        ]);
    }catch (\Exception $e) {
        return response()->json([
            'status' => 100,
            'message' => $e->getMessage()
        ]);
    }

    }

    public function destroy($id)
    {
        $setting = AppSetting::find($id);
        $setting->delete();
        return response()->json([
            'status' => 200,
            'message' => 'App Setting Deleted Successfully'
        ]);
    }

    public function changeStatus(Request $request, $id)
    {       
        try {
            AppSetting::where('id', $id)->update(['value2' => $request->value2]);
            return response()->json(['status' => 200,'success' => 'Status changed successfully.']);
         } catch (\Exception $e) {
             return response()->json([
                 'status' => 100,
                 'message' => $e->getMessage()
             ]);
         }
     }
}
