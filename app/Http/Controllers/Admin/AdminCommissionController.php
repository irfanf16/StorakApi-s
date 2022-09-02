<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commission;
use Illuminate\Http\Request;

class AdminCommissionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $commissions = Commission::with('childCategory.subcategory.category')
//                ->when($request->has('category_id') && $request->filled('category_id'),function ($query) use($request){
//                    $query->with('childCategory.subcategory.category')->whereHas('childCategory.subcategory.category',function ($query) use($request){
//                       $query->where('id','=',$request->id);
//                    });
//                })
                ->when($request->has('from_date') && $request->filled('from_date'),function ($query) use($request){
                    $query->whereDate('created_at','>=',$request->from_date);
                })
                 ->when($request->has('to_date') && $request->filled('to_date'),function ($query) use($request){
                                    $query->whereDate('created_at','<=',$request->to_date);
                                })
               ->orderBy('child_category_id')
                ->latest()
                ->get();
            return response()->json([
                'status' => 200,
                'commissions' => $commissions
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage()
            ]);
        }

    }

    public function appliedCommissionSection()
    {
        try {
            $categories = Category::with('subcategories.childcategories.appliedCommission')->get();
            return response()->json([
                'status' => 200,
                'categories' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function updateCommissions(Request $request)
    {


        try {
            foreach ($request->child_categories_id as $key => $childCategory) {
                if (isset($request->storak_commission[$key]) && isset($request->user_stores_commission[$key])) {
                    $commission = Commission::where([
                        'child_category_id' => $childCategory,
                        'storak_commission' => $request->storak_commission[$key],
                        'user_stores_commission' => $request->user_stores_commission[$key],
                    ])->latest()->first();
                    if ($commission) {
                        if ($commission->storak_commission != $request->storak_commission[$key] || $commission->user_stores_commission != $request->user_stores_commission[$key]) {
                            Commission::create([
                                'child_category_id' => $childCategory,
                                'storak_commission' => $request->storak_commission[$key],
                                'user_stores_commission' => $request->user_stores_commission[$key],
                            ]);
                        }
                    } else {
                        Commission::create([
                            'child_category_id' => $childCategory,
                            'storak_commission' => $request->storak_commission[$key],
                            'user_stores_commission' => $request->user_stores_commission[$key],
                        ]);
                    }
                }
            }
            return response()->json([
                'status' => 200,
                'message' => 'Commission set successfully.!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "something went wrong",
                'exception' => $e->getMessage()
            ]);
        }
    }
}
