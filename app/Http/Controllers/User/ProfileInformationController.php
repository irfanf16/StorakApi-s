<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\User;
class ProfileInformationController extends Controller
{
    /*
    |=================================================================
    | Get Customer Profile Information -- Edit Profile
    |=================================================================
    */
    public function editProfile()
    { 
        try{
            $profile_info = User::where('id', Auth::id())
                                ->select('id','name','email','is_email_verified','country_code','mobile','is_mobile_verified','profile_image')
                                ->first();

            return response()->json([
                'status'       => 200,
                'profile_info' => $profile_info
            ]);
            
        }
        catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status"    => 100,
                "message"   => "Sorry! Something Went Wrong.",
                "exceptions"=> $th
            ]);
        }
    }

    

    /*
    |=================================================================
    | Update Customer Profile Information -- Edit Profile
    |=================================================================
    */
    public function updateProfile(Request $request)
    {
        // return $request->all();
        // $inputs = array_merge($request->all(), ['mobile_no' => $request->country_code . $request->mobile]);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:100',
            // 'mobile_no' => 'required|unique:users,mobile,'.Auth::id(),
            // 'email' => 'required|unique:users,email,'.\Auth::id(),
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        // VALIDATE DUPLICATE MOBILE NUMBER
        $mobile_no_exists = User::where('id', '!=', Auth::id())
                                ->where(['country_code' => $request->country_code, 'mobile' => $request->mobile])
                                ->first();

        if($mobile_no_exists) {
            return response()->json([
                'status' => 100,
                'errors' => "mobile number already exists",
            ]);
        }

        $formData = [
            'name'         => $request->name,
            'country_code' => $request->country_code,
            'mobile'       => $request->mobile,
        ];

        // CHECK IF MOBILE-NO IS UPDATED
        $older_mobile_no = User::where([
                                    'id' => Auth::id(),
                                    'mobile'=>$request->mobile                            
                                ])->first();
        
        if(!$older_mobile_no){
            $formData['is_mobile_verified'] = false;
        }

        try{
            User::where('id', Auth::id())->update($formData);

            $updated_user = User::where('id', Auth::id())->first();
        
            return response()->json([
                "status"     => 200,
                "message"    => "Your profile is updated successfully",
                "update_user"=> $updated_user
            ]);  
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |=================================================================
    | Update Customer Password
    |=================================================================
    */
    public function updatePassword(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|string|min:8',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        try{
            // VALIDATE OLD PASSWORD
            if (!(Hash::check($request->old_password, Auth::user()->password))) {
                return response()->json([
                    'status' => '100',
                    'errors' => 'The old password is incorrect'
                ]);
            }

            User::where('id',Auth::id())
                ->update(['password' => Hash::make($request->new_password)]);

            return response()->json([
                'status' => '200',
                'message'=> 'You have updated your password successfully'
            ]);
        }
        catch (\Exception $e) {
            
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }

}