<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\FeatureCategoryResource;
use App\Http\Resources\MatchingFiltersResource;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;


class WebNavbarsController extends Controller
{
    /*
    |=============================================================================
    | Get List of All Active Categories with Subcategories And Childcategories
    |=============================================================================
    */
    public function categoriesWithSubcategories()
    {
        try {
            $categories = Category::with('subcategories.childcategories')
                                    ->where('status',1)
                                    ->select('id','title','title_ar','slug')
                                    ->orderBy('order','asc')
                                    ->get();

            $categories=MatchingFiltersResource::collection($categories);
            return response()->json([
                'status'     => 200,
                'categories' => $categories,
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
    |===========================================================================
    | Get List of All Active Featured Categories With Subcategories
    |===========================================================================
    */
    public function featuredCategories()
    {
        try {
            $fcategories = Category::with('subcategories')
                                ->where([
                                  'status'  => 1,
                                  'featured'=> 1
                                ])
                                ->select('id','title','title_ar','slug','logo_image')
                                ->orderBy('order','asc')
                                ->get();

            $fcategories=FeatureCategoryResource::collection($fcategories);
            return response()->json([
                'status'      => 200,
                'fCategories' => $fcategories,
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
    |===========================================================================
    | GET LIST OF ACTIVE POPULAR MAIN-CATEGORIES
    |===========================================================================
    */
    public function popularCategories()
    {
        try {
            $pcategories = Category::where([
                                    'status'  => 1,
                                    'popular' => 1
                                ])
                                ->select('id','title','title_ar','slug','logo_image')
                                ->get();

            $pcategories=CategoryResource::collection($pcategories);
            return response()->json([
                'status'      => 200,
                'pcategories' => $pcategories,
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
