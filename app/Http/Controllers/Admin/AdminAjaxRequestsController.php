<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\Variant;
use Illuminate\Http\Request;

class AdminAjaxRequestsController extends Controller
{
    /*
    |=====================================================
    |  Get Categories Using Ajax
    |=====================================================
     */
    public function categoriesList()
    {
        $categories = Category::where('status', 1)
            ->orderBy('title', 'asc')
            ->select('id', 'title')
            ->get();

        return response()->json([
            'status' => 200,
            'categories' => $categories,
        ]);
    }

    /*
    |=====================================================
    |  Get Specific Sub-Categories Using Ajax
    |=====================================================
     */
    public function subcategoriesList(Request $request)
    {
        $category_id = $request->categoryId;
        $subcategories = SubCategory::where('category_id', $category_id)
            ->orderBy('title', 'asc')
            ->select('id', 'title')
            ->get();
        return response()->json([
            'status' => 200,
            'subcategories' => $subcategories,
        ]);
    }
    /*
    |=====================================================
    |  Get Specific Child-Categories Using Ajax
    |=====================================================
     */

    public function childcategoriesList(Request $request)
    {
        $subcategory_id = $request->subcategoryId;
        $childcategories = ChildCategory::where('subcategory_id', $subcategory_id)
            ->orderBy('title', 'asc')
            ->select('id', 'title')
            ->get();
        return response()->json([
            'status' => 200,
            'childcategories' => $childcategories,
        ]);
    }

    /*
    |=====================================================
    |  Get Specific Variants Using Ajax
    |=====================================================
     */

    public function variantsList(Request $request)
    {
        $attribute_id = $request->attributeId;
        $variants = Variant::where('attribute_id', $attribute_id)
            ->orderBy('title', 'asc')
            ->select('id', 'title')
            ->get();

        return response()->json([
            'status' => 200,
            'variants' => $variants,
        ]);
    }

    public function multipleSubCategories(Request $request)
    {
        $category_id = $request->categoryId;
        $subcategories = SubCategory::with('category')
                                    ->whereIn('category_id', $category_id)
                                    ->orderBy('id', 'asc')
                                    ->get();
        return response()->json([
            'status' => 200,
            'subcategories' => $subcategories,
        ]);
    }

    public function multipleChildCategories(Request $request)
    {
        $subcategory_id = $request->subcategoryId;
        $childcategories = ChildCategory::whereIn('subcategory_id', $subcategory_id)
                                        ->with('subcategory:id,title', 'category:id,title')
                                        // ->orderBy('title', 'asc')
                                        // ->select('id', 'title')
                                        ->get();
        return response()->json([
            'status' => 200,
            'childcategories' => $childcategories,
        ]);
    }
}
