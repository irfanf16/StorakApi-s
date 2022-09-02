<?php

namespace App\Http\Controllers;

use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    /*
    |===============================================================
    | Remove Duplicate Records From Database Using Query Builder
    |================================================================
    */
    public function RemoveDuplicates()
    {
        $duplicated = DB::table('keys')
                        ->select('name', DB::raw('count(`name`) as occurences'))
                        ->groupBy('name')
                        ->having('occurences', '>', 1)
                        ->get();


        foreach ($duplicated as $duplicate) {
            Key::where('name', $duplicate->name)->forceDelete();
        }



        // $duplicateRecords = DB::table('keys')->select('name')
        //       ->selectRaw('count(`name`) as `occurences`'  )
        //       ->from('keys')
        //       ->groupBy('name')
        //       ->having('occurences', '>', 1)
        //       ->get();



        // dd($duplicateRecords);

    }
}
