<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;


class VendorCategoriesController extends Controller
{
    /*
    |========================================================
    | GET LIST OF ACTIVE MAIN-CATEGORIES
    |========================================================
    */
    public function categories()
    { 
        $categories = Category::where('status',1)
                              ->select('id','title','logo_image')
                              ->get();

        return response()->json([
            'status'    => 200,
            'categories'=> $categories,
        ]);
    }



    /*
    |=============================================================
    | GET LIST OF ACTIVE MAIN-CATEGORIES WITH SUB-CATEGORIES
    |=============================================================
    */
    public function categoriesWithSubcategories()
    { 
        $categories = Category::with('subcategories:id,title,image,category_id')
                              ->where('status',1)
                              ->select('id','title','logo_image')
                              ->get();

        return response()->json([
            'status'    => 200,
            'categories'=> $categories,
        ]);
    }



    /*
    |===================================================================
    | GET LIST OF ACTIVE MAIN-CATEGORIES WITH SUB-AND-CHILD-CATEGORIES
    |===================================================================
    */
    public function categoriesWithSubAndChildcategories()
    { 
        $categories = Category::with('subcategories.childcategories')
                              ->where('status',1)
                              ->select('id','title','logo_image')
                              ->get();

        return response()->json([
            'status'    => 200,
            'categories'=> $categories,
        ]);
    }


    /*
    |===========================================================
    | GET LIST OF ACTIVE SUB-CATEGORIES
    |===========================================================
    */
    public function subcategories()
    { 
        $subcategories = SubCategory::where('status',1)
                                    ->select('id','title','image')
                                    ->get();
        
        return response()->json([
            'status'       => 200,
            'subcategories'=> $subcategories,
        ]);
    }



    /*
    |===========================================================
    | GET LIST OF ACTIVE SUB-CATEGORIES WITH MAIN-CATEGORY
    |===========================================================
    */
    public function subcategoriesWithMaincategory()
    { 
        $subcategories = SubCategory::with('category:id,title')
                                    ->where('status',1)
                                    ->select('id','title','image','category_id')
                                    ->get();

        // dd($subcategories->toArray());

        return response()->json([
            'status'       => 200,
            'subcategories'=> $subcategories,
        ]);
    }



    /*
    |===============================================================
    | GET LIST OF ACTIVE SUB-CATEGORIES WITH CHILD-CATEGORIES
    |===============================================================
    */
    public function subcategoriesWithChildcategories()
    { 
        $subcategories = SubCategory::with('childcategories:id,title,image,subcategory_id')
                                    ->where('status',1)
                                    ->select('id','title','image')
                                    ->get();

        return response()->json([
            'status'       => 200,
            'subcategories'=> $subcategories,
        ]);
    }


    
    /*
    |============================================================
    | GET LIST OF ACTIVE CHILD-CATEGORIES
    |============================================================
    */
    public function childcategories()
    { 
        $child_categories = ChildCategory::where('status',1)
                                         ->select('id','title','image')
                                         ->get();

        return response()->json([
            'status'          => 200,
            'child_categories'=> $child_categories,
        ]);
    }


    /*
    |============================================================
    | GET LIST OF ACTIVE CHILD-CATEGORIES WITH SUB-CATEGORY
    |============================================================
    */
    public function childcategoriesWithSubcategory()
    { 
        $child_categories = ChildCategory::with('subcategory:id,title')
                                         ->where('status',1)
                                         ->select('id','title','image', 'subcategory_id')
                                         ->get();

        return response()->json([
            'status'          => 200,
            'child_categories'=> $child_categories,
        ]);
    }



    /*
    |==========================================================================
    | GET LIST OF ACTIVE CHILD-CATEGORIES WITH SUB-CATEGORY AND MAIN-CATEGORY
    |==========================================================================
    */
    public function childcategoriesWithSubAndMainCategory()
    { 
        $child_categories = ChildCategory::with('category:id,title')
                                         ->with('subcategory:id,title')
                                         ->where('status',1)
                                         ->select('id','title','image', 'category_id', 'subcategory_id')
                                         ->get();

        return response()->json([
            'status'          => 200,
            'child_categories'=> $child_categories,
        ]);
    }

    

    
}