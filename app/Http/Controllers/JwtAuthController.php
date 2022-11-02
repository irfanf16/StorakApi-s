<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Models\User;
use App\Models\SubRole;
use App\Models\UserAddress;
use App\Models\Notification;

use App\Http\Controllers\Vendor\StoreController;
use Illuminate\Support\Str;

class JwtAuthController extends Controller
{
    /*
    |======================================================================
    | CREATE A NEW AUTH-CONTROLLER INSTANCE
    |======================================================================
    */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => [
            'login',
            'register',
            'validateUniqueEmail',
            'validateUniqueMobile',
            'vendorRegister',
            'socialLogin',
            'logout',
            'me'
        ]
        ]);
    }


    /*
    |======================================================================
    | AUTHENTICATE USER LOGIN REQUEST
    |======================================================================
    */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->all()
            ]);
        }
        $user = User::where(['email' => $request->email])->first();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'Account not exists, Please register first.!',
            ]);
        }

        $credentials = request(['email', 'password']);
        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'status' => 401,
                'message' => 'Sorry! the credentials you are using are invalid',
            ]);
        }
        if ($request->remember == 1) {
            auth()->user()->update(['remember_token' => Str::random(10)]);
        } else {
            auth()->user()->update(['remember_token' => null]);
        }
        $notifications_count = Notification::where('store_id', Auth::user()->store->id ?? 0)->count();

//        $user = Auth::user();
//        // return response()->json($user);
//        if ($user->role_id == 1) {
//
//        } elseif ($user->role_id == 2) {
//            $user = User::where('email', $request->email)->with('Subrole')->first();
//            $subrole = SubRole::where('id', 2)->first();
//            if (StoreController::isOwner($user->id)) {
//                if (!$user->subrole) {
//                    $subrole->users()->attach($user->id);
//                }
//
//            }
//        }

        return $this->respondWithToken($token, $notifications_count);

        /* IMPORTANT
        |-------------------------------------------------------
        | CUSTOMIZED CODE
        |-------------------------------------------------------

            $token = auth()->attempt($credentials);
            if ($token) {
                $user = User::find(\Auth::id());

                return response()->json([
                    'status' => 200,
                    'message'=> 'You Are Login Successfully',
                    'token'  => $token,
                    'user'   => $user,
                ]);
            }
            return response()->json([
                'status' => 401,
                'message'=> 'Sorry! the credentials you are using are invalid',
            ]);

        |--------------------------------------------------------
        |--------------------------------------------------------
        */
    }


    /*
    |======================================================================
    | REGISTER A NEW USER (CUSTOMER) USING SIGN-UP FORM
    |======================================================================
    */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'country_code' => 'required|string|max:4',
            'mobile' => 'required|string|min:8|max:11',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all(),
            ]);
        }
        $user = User::where('email', $request->email)->latest()->first();
        if ($user) {
            return response()->json([
                'status' => 100,
                'errors' => "Email already exists.!",
            ]);
        }
//        // VALIDATE DUPLICATE MOBILE NUMBER
//        if (User::where(['country_code' => $request->country_code, 'mobile' => $request->mobile])->first()) {
//            return response()->json([
//                'status' => 100,
//                'errors' => "mobile number already exists",
//            ]);
//        }


        $user = new User();
        $user->role_id = 3; // USER
        $user->name = $request->name;
        $user->email = $request->email;
        $user->country_code = $request->country_code;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->registered_with = "signup";
        $is_user_created = $user->save();


        // SENDING TOKEN WITH LOGIN USER PROFILE DETAILS
        if ($is_user_created) {

            $token = auth()->attempt(request(['email', 'password']));
            $notifications_count = Notification::where('store_id', Auth::user()->store->id ?? 0)->count();

            return $this->respondWithToken($token, $notifications_count);
        } else {
            return response()->json([
                'status' => 100,
                'message' => "Sorry, something went wrong"
            ]);
        }

        /*
        |=================================================================
        | IF YOU WANT TO SEND USER TO LOGIN SCREEN AFTER REGISTERATION
        |=================================================================
        |    return response()->json([
        |        'status'  => 200,
        |        'message' => 'You are registered Successfully',
        |    ]);
        |
        */
    }


    /*
    |======================================================================
    | REGISTER A NEW VENDOR USING SIGN-UP FORM -- STORE E-VERIFICATION LINK
    |======================================================================
    */
    public function vendorRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'country_code' => 'required|string|max:4',
            'mobile' => 'required|string|min:8|max:11',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all(),
            ]);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json([
                'status' => 100,
                'errors' => "Email already exists.!",
            ]);
        }

        // VALIDATE DUPLICATE MOBILE NUMBER
        if (User::where(['country_code' => $request->country_code, 'mobile' => $request->mobile])->first()) {
            return response()->json([
                'status' => 100,
                'errors' => "mobile number already exists",
            ]);
        }

        $user = new User();
        $user->role_id = 2; // VENDOR
        $user->name = $request->name;
        $user->email = $request->email;
        $user->country_code = $request->country_code;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->registered_with = "signup";
        $user->vendor_profile_status = 0;
        $user->email_confirmation_code = $request->confirmation_code;

        $is_user_created = $user->save();

        if ($is_user_created) {

            $user = User::where('email', $request->email)->first();

            $subrole = SubRole::where('id', 2)->first();

            $subrole->users()->sync($user->id);


            $token = auth()->attempt(request(['email', 'password']));
            $notifications_count = Notification::where('store_id', Auth::user()->store->id ?? 0)->count();

            return $this->respondWithToken($token, $notifications_count);
        } else {
            return response()->json([
                'status' => 100,
                'message' => "Sorry, something went wrong"
            ]);
        }

    }


    /*
    |======================================================================
    | REGISTER A NEW USER USING SOCIAL LOGINS
    |======================================================================
    */
    public function socialLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'provider_id' => 'required',
            'registered_with' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all(),
            ]);
        }
        $user_exists = User::where(['provider_id' => $request->provider_id])->latest()->first();
        if ($user_exists) {

            if (!$user_exists->email) {
                $updateUserDetails['email'] = $request->email;
            }
            if (!$user_exists->country_code) {
                $updateUserDetails['country_code'] = $request->country_code;
            }
            if (!$user_exists->mobile) {
                $updateUserDetails['mobile'] = $request->mobile;
            }
            if (!$user_exists->email_verified_at) {
                $updateUserDetails['email_verified_at'] = Carbon::now();
            }

            if (!$user_exists->avatar) {
                $updateUserDetails['profile_image'] = $request->profile_image;
            }
            $user_exists->update($updateUserDetails);
//            $isUpdated = User::where('email', $request->email)->update($updateUserDetails);
//            if ($isUpdated) {

//                $user = User::where('email', $request->email)->first();
            Auth::login($user_exists);
            $notifications_count = Notification::where('store_id', $user->store->id ?? 0)->count();
            return $this->respondWithToken(auth()->refresh(), $notifications_count);

//            }

        } else {
            $user = new User();
            $user->name = $request->name;
            $user->role_id = 3; // USER / CUSTOMER
            $user->email = $request->email;
            $user->email_verified_at = Carbon::now();
//            $user->profile_image    = $request->profile_image;
            $user->registered_with = $request->registered_with;
            $user->provider_id = $request->provider_id;
            $user->last_login = Carbon::now();
            $user->password = bcrypt(rand(1000, 10000));
            $user->save();
            Auth::login($user);
            $notifications_count = Notification::where('store_id', $user->store->id ?? 0)->count();
            return $this->respondWithToken(auth()->refresh(), $notifications_count);

        }


    }


    /*
    |======================================================================
    | Logout Current User (Invalidate/blacklist the existing token)
    |======================================================================
    */
    public function logout()
    {
        try {
            Auth::logout();
            return response()->json([
                'status' => '200',
                'message' => 'Successfully logged out',
                'user' => Auth::user()
            ]);

        } catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }

    }


    /*
    |=====================================================================
    |  Validate Email-Address For Uniqueness
    |=====================================================================
    */
    public function validateUniqueEmail(Request $request)
    {
        try {
            $email = $request->email;
            $user = User::where('email', $email)->first();

            if ($user) {
                return response()->json([
                    'status' => 200,
                    'isAlreadyUsed' => true
                ]);
            } else {
                return response()->json([
                    'status' => 200,
                    'isAlreadyUsed' => false
                ]);
            }
        } catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }

    }

    /*
    |=====================================================================
    |  Validate Email-Address For Uniqueness
    |=====================================================================
    */
    public function accountDelete(Request $request)
    {
        try {

            if ($request->email || $request->provider_id) {
                if ($request->email) {
                    $validator = Validator::make($request->all(), [
                        'email' => 'required|email',
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'status' => 100,
                            'errors' => $validator->errors()->all(),
                        ]);
                    }
                    $user = User::where(['email' => $request->email])->first();

                } else {
                    $validator = Validator::make($request->all(), [
                        'provider_id' => 'required',
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'status' => 100,
                            'errors' => $validator->errors()->all(),
                        ]);
                    }
                    $user = User::where(['provider_id' => $request->provider_id])->first();
                }
                if (!$user) {
                    return response()->json([
                        'status' => 100,
                        'errors' => 'user not found.!'
                    ]);
                }
                $user->user_stores()->delete();
                $user->delete();
                Auth::logout();
                return response()->json([
                    'status' => 200,
                    'account Delete' => true
                ]);
            } else {
                return response()->json([
                    'status' => 100,
                    'errors' => 'must be given Email or provider_id'
                ]);
            }


        } catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }

    }


    /*
    |=====================================================================
    |  Validate Mobile-Number For Uniqueness
    |=====================================================================
    */
    public function validateUniqueMobile(Request $request)
    {
        try {
            $mobile = $request->mobile_no;

            if (User::where('mobile', $mobile)->first()) {
                return response()->json([
                    'status' => 200,
                    'isAlreadyUsed' => true
                ]);
            }
            return response()->json([
                'status' => 200,
                'isAlreadyUsed' => false
            ]);

        } catch (\Throwable $th) {

            // throw $th;
            return response()->json([
                "status" => 100,
                "message" => "Sorry! Something Went Wrong.",
                "exceptions" => $th
            ]);
        }

    }


    /*
    |======================================================================
    | Get Authenticated User
    |======================================================================
    */
    public function me()
    {
        return Auth::user();
        return response()->json(auth()->user());
    }


    /*
    |======================================================================
    | Refresh JWT Token
    |======================================================================
    */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(), 0);
    }


    /*
    |======================================================================
    | GET THE TOKEN ARRAY (TOKEN FULL DETAILS)
    |======================================================================
    */
    protected function respondWithToken($token, $notifications_count)
    {
        $user_addresses = UserAddress::where('user_id', Auth::id())->get();
        $user = User::with('store','user_store')->where('id', Auth::user()->id)->with('Subrole')->first();
        $user_role_permissions = User::with('role.permissions')->find(Auth::id());
        // if($user->subrole == null){
        //     $user['subrole'] = ['hell'];
        // }
        return response()->json([
            'status' => 200,
            'message' => "Successfully logged In",
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            // 'expires_in' => config('ttl'), // CUSTOMIZATION OF TOKEN-EXPIRE-TIME
            'user' => $user,
            'user_role_permissions' => $user_role_permissions->role,
            'store' => $user->store,
            'user_store' =>$user->user_store ? true : false,
            'user_addresses' => $user_addresses,
            'notifications' => $notifications_count
        ]);

    }

}
