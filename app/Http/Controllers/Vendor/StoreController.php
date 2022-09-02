<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // get store owner
    public function getOwner($id){

        $store = Store::where('user_id' , $id)->first();

        if($store){
            return response()->json($store);
        }
        else{
            return null;
        }
    }


    public static function isOwner($id){

        $store = Store::where('user_id' , $id)->first();

        if($store){
            return true;
        }
        else{
            return false;
        }


    }



}