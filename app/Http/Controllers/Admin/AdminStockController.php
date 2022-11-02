<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class AdminStockController extends Controller
{

    public function index(Request $request)
    {
        try {

            $productVariants = ProductVariant::with('product.category.subcategories.childcategories')
                ->with('product.subcategory:id,title')
                ->with('product.childcategory:id,title')
                ->with('product.category.brands')
                ->with('product.brand:id,name')
                ->with('product.store:id,store_name')
                ->with('product.images')
                ->with('product.productAttributes', function ($query) {
                    $query->with('attributeDetail:id,title');
                    $query->with('attributeDetail.keys');
                    $query->with('keyDetail:id,name');
                })
                ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . "%");
                })
                ->when($request->has('status') && $request->filled('status'), function ($query) use ($request) {
                    $query->where('availability', $request->status);
                })
                ->when($request->has('from_date') && $request->filled('from_date'), function ($query) use ($request) {
                    $query->where('updated_at', '>=', $request->from_date);
                })
                ->when($request->has('from_to') && $request->filled('from_to'), function ($query) use ($request) {
                    $query->where('updated_at', '<=', $request->from_to);
                })
                ->latest()
                ->paginate($request->datatable_length);


            $total_stock = ProductVariant::sum('quantity');
            $sold_stock = ProductVariant::sum('sold_stock');
            $in_stock = ProductVariant::where('availability', 1)->count();
            $out_stock = ProductVariant::where('availability', 0)->count();

            return response()->json([
                'status' => 200,
                'productVariants' => $productVariants,
                'total_stock' => $total_stock,
                'sold_stock' => $sold_stock,
                'in_stock' => $in_stock,
                'out_stock' => $out_stock,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => "sorry, something went wrong",
                'errors' => $e->getMessage(),
            ]);
        }

    }
    public function changeStatus(Request $request)
    {
        try {
            ProductVariant::where('id', $request->id)->update(['availability' => $request->status]);
            return response()->json(['status' => 200,'success' => 'Status changed successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }

}
