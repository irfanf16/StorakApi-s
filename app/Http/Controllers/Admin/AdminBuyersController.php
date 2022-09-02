<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\City;

class AdminBuyersController extends Controller
{
    /*
    |==================================================
    | Get Listing of All Buyers from storage
    |==================================================
    */
    public function index()
    {
      try {
        $users                  = User::where('role_id',3)->get();
        $users_count            = count($users );
        $active_users_count     = $users ->where([['role_id',3],['status',1]])->count();
        $inactive_users_count   = $users ->where([['role_id',3],['status',0]])->count();
        $verified_users_count   = $users ->where([['role_id',3],['is_mobile_verified',1]])->count();
        $unverified_users_count = $users ->where([['role_id',3],['is_mobile_verified',0]])->count();

        return response()->json([
            'status'                => 200,
            'users'                 => $users,
            'users_count'           => $users_count,
            'active_users_count'    => $active_users_count,
            'inactive_users_count'  => $inactive_users_count,
            'verified_users_count'  => $verified_users_count,
            'unverified_users_count'=> $unverified_users_count,
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



    /*
    |===================================================
    | Show the form for creating a new resource
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

    }



    /*
    |==========================================================
    | Get specified Vendor from storage for Read only
    |==========================================================
    */
    public function show($id)
    {
        //
    }



    /* 
    |==========================================================
    | Get Specified Vendor from storage For Editing
    |==========================================================
    */
    public function edit($id)
    {
        $user   = User::with('store')->where('id',$id)->first();
        $cities = City::select('id','name')->get();

        return response()->json([
            'status' => 200,
            'user'   => $user,
            'cities' => $cities,
        ]);
    }



    /* 
    |====================================================
    | Update the specified Vendor in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    { 

    }



    /*
    |====================================================
    | Remove the specified Vendor from storage.
    |====================================================
    */
    public function destroy($id)
    {
        //
    }

}
