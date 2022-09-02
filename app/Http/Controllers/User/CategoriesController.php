<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\City;
use App\Models\MobileCover;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Variant;


class CategoriesController extends Controller
{
    /*
    |==================================================
    | GET LIST OF ALL SUB-CATEGORIES
    |==================================================
    */
    public function subCategories()
    {
        try {
            $subCategories = SubCategory::where('status',1)
                                        ->select('id','title','slug')
                                        ->get();

            return response()->json([
                'status'        => 200,
                'subCategories' => $subCategories,
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
    |==================================================
    | GET LIST OF ALL CHILD-CATEGORIES
    |==================================================
    */
    public function childCategories()
    {
        try {
            $childCategories = ChildCategory::where('status',1)
                                            ->select('id','title','slug')
                                            ->get();

            return response()->json([
                'status'          => 200,
                'childCategories' => $childCategories,
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
    |==================================================
    | GET LIST OF ALL BRANDS
    |==================================================
    */
    public function brands()
    {
        try {
            $brands = Brand::where('status',1)
                            ->select('id','name','slug')
                            ->get();

            return response()->json([
                'status' => 200,
                'brands' => $brands,
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
    |==================================================
    | GET LIST OF ALL ATTRIBUTES
    |==================================================
    */
    public function attributes()
    {
        try {
            $attributes = Attribute::where('status',1)
                                    ->select('id','title')
                                    ->get();

            return response()->json([
                'status'     => 200,
                'attributes' => $attributes,
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
    |==================================================
    | GET LIST OF ALL VARIANTS
    |==================================================
    */
    public function variants()
    {
        try {
            $variants = Variant::where('status',1)
                                ->select('id','title')
                                ->get();

            return response()->json([
                'status'   => 200,
                'variants' => $variants,
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
    |==================================================
    | GET LIST OF ALL CITIES
    |==================================================
    */
    public function cities()
    {
        try {
            $cities = City::where('status',1)
                        ->select('id','name')
                        ->get();

            return response()->json([
                'status' => 200,
                'cities' => $cities,
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
    |==================================================
    | GET LIST OF ALL MOBILE HOMESCREEN COVERS
    |==================================================
    */
    public function mobileCovers()
    {
        try {
            $covers = MobileCover::where('status',1)
                                ->select('id','image')
                                ->get();

            return response()->json([
                'status' => 200,
                'covers' => $covers,
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


}
