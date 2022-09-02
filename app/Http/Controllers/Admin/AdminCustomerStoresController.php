<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserStore;
use Illuminate\Http\Request;
use App\Models\Collection;

class AdminCustomerStoresController extends Controller
{
    /*
    |===========================================================
    | Get Listing of All Customer-Stores From Storage -- 
    |===========================================================
    */
    public function index()
    {
        try {
            $stores = UserStore::with('customerDetails:id,name,email,phone,mobile')
                                ->get();

            $stores_count      = count($stores);
            $active_stores     = $stores->where('status',1)->count();
            $inactive_stores   = $stores->where('status',0)->count();
            $verified_stores   = $stores->where('is_verified',1)->count();
            $unverified_stores = $stores->where('is_verified',0)->count();
            $featured_stores   = $stores->where('featured',1)->count();

            return response()->json([
                'status'           => 200,
                'stores'           => $stores,
                'stores_count'     => $stores_count,
                'active_stores'    => $active_stores,
                'inactive_stores'  => $inactive_stores,
                'verified_stores'  => $verified_stores,
                'unverified_stores'=> $unverified_stores,
                'featured_stores'  => $featured_stores,
            ]);

        } 
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message"=> "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userStore = UserStore::where('id' ,$id)->with('collections.products', 'customerDetails:id,name,email,phone,mobile')->first();
        return response()->json([
            'status'  => 200,
            'userStore'=> $userStore
        ]);
    }

    public function collections($id)
    {
        $collections = Collection::where('id', $id)->with('store.customerDetails', 'products')->first();

        return response([
            'status' => 200,
            'collections' => $collections
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        try {
            if ($request->has('status')) {
                UserStore::where('id', $request->customer_store_id)->update(['status' => $request->status]);
            } else {
                UserStore::where('id', $request->customer_store_id)->update(['featured' => $request->featured]);
            }
            return response()->json(['status' => 200, 'success' => 'Status changed successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function collectionVisibility(Request $request)
    {
        try {
            
            Collection::where('id', $request->collection_id)->update(['visibility' => $request->visibility]);
            
            return response()->json([ 'status' => 200,'success' => 'Visibility changed successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }
}
