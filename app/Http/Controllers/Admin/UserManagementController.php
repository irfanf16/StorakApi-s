<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Store;
use App\Models\SubRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    //

    public function createUser(Request $request)
    {


//        $admin = User::where('id', Auth::user()->id)->with('store')->first();
        // return ($admin);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'string|min:8|max:11',
            'password' => 'required|min:8',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $user = new User();
        $user->role_id = 1; // VENDOR
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->registered_with = "signup";
        $user->vendor_profile_status = 0;
        // $user->email_confirmation_code= $request->confirmation_code;

        $user->save();

        $role = SubRole::find($request->subrole_id);
        $role->users()->attach($user->id);
        return response()->json([
            "status" => 200,
            "user" => $user
        ]);
    }


    public function updateUser(Request $request, $id)
    {

        $admin = User::where('id', Auth::user()->id)->with('store')->first();
        // return ($admin);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'mobile' => 'string|min:8|max:11',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $user = User::where('id', $id)->first();

        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $is_user_created = $user->save();

            $user->load('store');

            return response()->json([
                "status" => 200,
                "user" => $user
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "User Not found"
            ]);
        }
    }

    public function findUser($id)
    {
        $admin = User::where('id', Auth::user()->id)->with('store', 'store.user')->first();
        $store = $admin->store;
        $userids = $store->user->where('id', '!=', Auth::user()->id)->pluck('id');

        $user = User::whereIn('id', $userids)->with('Subrole')->first();

        if ($user) {
            return response()->json([
                "status" => 200,
                "user" => $user
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "User Not Found"
            ]);
        }
    }

    // list users of this store vendor
    public function listUser()
    {


        $users = User::where('role_id', 1)->where('id', '>', 1)->with('Subrole')->get();

        return response()->json([
            "status" => 200,
            "users" => $users
        ]);
    }

    public function createSubrole(Request $request)
    {

        // dd(SubRole::all());

        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:100"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $subrole = SubRole::create([
            "name" => $request->name,
            "owner_id" => 0
        ]);
        $subrole->permissions()->sync($request->permissions);

        return response()->json([
            "status" => 200,
            "message" => "Role has been Created Successfully",
            "subrole" => $subrole
        ]);
    }


    public function updateSubrole(Request $request, $id)
    {

        // dd(SubRole::all());

        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:100"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $subrole = SubRole::where('id', $id)->first();
        $subrole->name = $request->name;
        $subrole->save();
        $subrole->permissions()->sync($request->permissions);


        return response()->json([
            "status" => 200,
            "message" => "Role has been Updated Successfully",
            "subrole" => $subrole
        ]);
    }

    // list Subroles of this store vendor
    public function listSubrole()
    {

        $subroles = SubRole::where('owner_id', 0)->where('name', '!=', 'Storak Admin')->where('name', '!=', 'Vendor Admin')->get();
//        $modules = config('modules-beta.vendor');
//        $blank = config('modules-blank.vendor');
        $permissions = Permission::where('permission_type', 'admin')->get();
        return response()->json([
            "status" => 200,
            "subroles" => $subroles,
            'permissions' => $permissions,
        ]);
    }

    // find Subrole of this store vendor
    public function findSubrole($id)
    {

        $subrole = SubRole::find($id);
        $permissions = Permission::where('permission_type', 'admin')->get();
        $rolePermissions = DB::table("subrole_permissions")->where("subrole_permissions.subrole_id", $id)
            ->pluck('subrole_permissions.permission_id')
            ->all();
        return response()->json([
            "status" => 200,
            "subrole" => $subrole,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,

        ]);
    }


    public function listModules()
    {
        $modules = config('modules-beta.vendor');
        $blank = config('modules-blank.vendor');
        return response()->json([
            "status" => 200,
            "modules" => $modules,
            'blank' => $blank
        ]);
    }


    public function createSubrolePermissions(Request $request)
    {
        // dd($request->all());
        $permissions = json_encode($request->permissions);
        $subrole_id = $request->subrole_id;

        $subrole = SubRole::where('id', $subrole_id)->first();
        $subrole->permissions = $permissions;
        $subrole->save();


        return response()->json([
            "status" => 200,
            "permissions" => json_decode($permissions)
        ]);


        // $module  = "products.add_products";
        // $opration = "create";

        // $module  = explode("." , $module);
        // // dd($module);

        // foreach($module as $m){
        //     if(isset($permissions[$m])){

        //         $permissions = $permissions[$m];
        //     }
        //     else{
        //         return "Module ($m) does not exist";
        //     }

        // }

        // $module = $permissions;

        // if(isset($module)){

        //     if(in_array($opration , $module['oprations'])){
        //         return true;
        //     }
        //     else{

        //         return false;
        //     }
        // }else{
        //     return "Module does not exit";
        // }


    }


    public function assignSubrole(Request $request)
    {
        // return($request->all());

        $validator = Validator::make($request->all(), [
            "user_id" => "required",
            "subrole_id" => "required",

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $user = User::where('id', $request->user_id)->with('Subrole')->first();

        if (isset($user->subrole->id)) {
            $oldrole = SubRole::where('id', $user->subrole->id)->first();
        } else {
            $oldrole = null;
        }


        if ($user) {
            // $oldrole = SubRole::where('id' , $user->subrole->id)->first();
            // dd($oldrole);

            $subrole = SubRole::where('id', $request->subrole_id)->first();

            if ($oldrole) {
                $oldrole->users()->detach($user->id);
            }

            $subrole->users()->attach($user->id);


            $user->load('Subrole');

            $user = User::where('id', $user->id)->with('Subrole')->first();


            return response()->json([
                "status" => 200,
                "user" => $user,
            ]);
        } else {
            return response()->json([
                "status" => 404,
                "message" => "User Not Found"
            ]);
        }
    }
}
