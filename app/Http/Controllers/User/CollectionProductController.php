<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Collection;
use App\Models\Product;

class CollectionProductController extends Controller
{
    /*
    |=================================================================
    | Add New Product to Collection by MyStore Auth User -- 
    |=================================================================
    */
    public function AddProduct(Request $request , $collection_id)
    {
        try {
            if(!$request->product_id){
                return response()->json([
                    'status'  => 100,
                    'message' => "Ops! <product_id> is required ",
    
                ]);
            }
    
            $collection = Collection::where('id' , $collection_id)->first();
            // in_array($request->product_id , $collection->products()->get()->pluck('id')->toArray() )
    
            if( ! $collection->products()->where('product_id' , $request->product_id)->exists()){
    
                $collection->products()->attach($request->product_id);
    
                return response()->json([
                    'status'  => 200,
                    'message' => "Great ! product is added to collection",
    
                ]);
            }
            else{
                return response()->json([
                    'status'  => 100,
                    'message' => "Product already Exist in Collection",
    
                ]);
            }

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }

    }



    /*
    |=================================================================
    | Remove Single Product From a Specific Collection 
    |=================================================================
    */
    public function RemoveProduct(Request $request , $collection_id)
    {
        try {
            if(!isset($request->product_id)){
                return response()->json([
                    'status'  => 100,
                    'message' => "Ops! <product_id> is required ",

                ]);
            }

            $collection = Collection::where('id' , $collection_id)->first();

            $collection->products()->detach($request->product_id);

            return response()->json([
                'status'  => 200,
                'message' => "Alright ! product is Removed from collection",

            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }
        
    }



    /*
    |=================================================================
    | Remove Multiple Product From a Specific Collection -- 
    |=================================================================
    */
    public function RemoveManyProduct(Request $request , $collection_id)
    {
        try {
            if(!isset($request->product_ids)){
                return response()->json([
                    'status'  => 100,
                    'message' => "Ops! <product_id> is required ",
                ]);
            }

            $collection = Collection::where('id' , $collection_id)->first();

            $collection->products()->detach($request->product_ids);

            return response()->json([
                'status'  => 200,
                'message' => "Alright ! product is Removed from collection",

            ]);
        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }

    }



    /*
    |=================================================================
    | Get Listing of All Products For a Specific Collection -- 
    |=================================================================
    */
    public function AllProduct($collection_id)
    {
        try {
            $collection = Collection::where('id' , $collection_id)
                                    ->withCount('products')
                                    ->with(
                                        'products',
                                        'products.firstVariant:id,price,special_price,product_id',
                                        'products.brand',
                                        'products.category:id,title'
                                    )
                                    ->first();
    
            return response()->json([
                'status'  => 200,
                'collection' => $collection
            ]);
    
        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> 'sorry, something went wrong',
                "errors" => $e->getMessage()
            ]);
        }

    }



    /*
    |=================================================================
    | Get Listing of Most Viewed Products For a Specific Collection -- 
    |=================================================================
    */
    public function MostViewed()
    {
        try {
            return response()->json([
                'status' => 200,
                'message'=> ""
            ]);
        } 
        catch (\Throwable $th) {
            throw $th;
        }
    }

}
