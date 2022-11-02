<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\User;
use App\Models\UserStore;
use App\Traits\ApiDataGenerate;
use App\Traits\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    use ApiHelper,ApiDataGenerate;

    /*
    |=================================================================
    | Get Collections Listing of Auth-User's MyStore -- Manage Profile
    |=================================================================
    */
    public function index()
    {
        try{
            $user = User::where('id', Auth::user()->id)
                        ->with('user_store')
                        ->with('user_store.collections' , function($q){
                            $q->withCount('products');
                        })
                        ->first();

            if($user->user_store){

                return response()->json([
                    'status'  => 200,
                    'collections'=> $user->user_store->collections
                ]);
            }
            else{
                return response()->json([
                    'status'  => 100,
                    'message' => "Ops! Looks like you dont have a Store ",

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
    | Show The Form For Creating a New Resource --
    |=================================================================
    */
    public function create()
    {
        //
    }



    /*
    |=================================================================
    | Store A Newly Created Collection in Database For Auth User --
    |=================================================================
    */
    public function store(Request $request)
    {
        try{
            $user = User::where('id' , Auth::user()->id)
                        ->with('user_store')
                        ->first();

            if($user->user_store){

                $validator = Validator::make($request->all(), [
                    'name'       => 'required|max:300',
                    'visibility' => 'required|integer'
                ]);

                if($validator->fails()){
                    return response()->json([
                        'status' => 100,
                        'errors' => $validator->errors()->all()
                    ]);
                }

                $code = $this->generateRandomString(8);

                $formdata= [
                    'name'          => $request->name,
                    'slug'          => $this->createSlug('collections',$request->name),
                    'user_store_id' => $user->user_store->id,
                    'code'          => $code,
                    'visibility'    => $request->visibility
                ];

                $collection = Collection::create($formdata);

                $collection = Collection::where('id' , $collection->id)->first();

                return response()->json([
                    'status'  => 200,
                    'message' => "Awesome, Your Collection Is Created",
                    'collection'=> $collection
                ]);
            }
            else{
                return response()->json([
                    'status'  => 100,
                    'message' => "Ops! Looks like you don't have a Store ",
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
    | Get Auth-User Specific Collection Details --
    |=================================================================
    */
    public function show($id)
    {
        //
    }



    /*
    |=================================================================
    | Store A Newly Created Collection in Database -- Auth User
    |=================================================================
    */
    public function edit($id)
    {
        //
    }



    /*
    |=================================================================
    | Update Specific Collection Details in Database -- Auth User
    |=================================================================
    */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'       => 'required|max:300',
                'visibility' => 'required|integer',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->errors()->all()
                ]);
            }

            $formdata = [
                'name'       => $request->name,
                'visibility' => $request->visibility
            ];

            $collection  = Collection::where('id' , $id)->update($formdata);
            $collection  = Collection::where('id' , $id)->first();

            return response()->json([
                'status'  => 200,
                'message' => "Awesome, Your Collection Is Updated",
                'collection'=> $collection
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
    | Delete Specific Collection From Database -- For Auth User
    |=================================================================
    */
    public function destroy($id)
    {
        try {
            $collection  = Collection::where([
                                        'id' => $id,
                                        'user_store_id' => Auth::user()->user_store->id
                                    ])->first();

            if($collection){
                $collection->delete();
            }
            else{
                return response()->json([
                    'status'  => 404,
                    'message' => "Ops! This collection Does not Exist",
                ]);
            }

            return response()->json([
                'status'  => 200,
                'message' => "Alright! Collection is Removed",
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
    | Delete Multiple Collections in Database -- For Auth User
    |=================================================================
    */
    public function deleteMany(Request $request)
    {
        try {
            $collections  = Collection::where('user_store_id' , Auth::user()->user_store->id)
                                      ->whereIn('id' , $request->collection_ids)
                                      ->get();

            foreach($collections as $collection){
                if($collection){
                    $collection->delete();
                }
                else{
                    return response()->json([
                        'status'  => 404,
                        'message' => "Ops! This collection Does not Exist",
                    ]);
                }
            }

            return response()->json([
                'status'  => 200,
                'message' => "Alright! Collections are Removed",
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
    | Generate a Random String --
    |=================================================================
    */
    function generateRandomString($length = 25)
    {
        try {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            return $randomString;

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
    | Increment/Decrement Collection Likes --
    |=================================================================
    */
    public function likeCollection( Request $request ,  $store_code , $collection_id )
    {
        try {
            $collection = Collection::where('id' , $collection_id)->first();

            // return response()->json([
            //     'status'  => 40400000000000000,
            //     'message' => $collection_id
            // ]);
            // return $request->collection;

            if($collection){

                $check = $collection->likers()->where('user_id' , Auth::user()->id )->exists();

                if(!$check){

                    $collection->likers()->attach(Auth::user()->id);
                    $collection->likes = $collection->likes + 1;
                    $collection->save();

                    return response()->json([
                        'status'  => 200,
                        'message' => 'You liked this collection'
                    ]);
                }
                else{
                    $collection->likers()->detach(Auth::user()->id);
                    $collection->likes = $collection->likes - 1;
                    $collection->save();

                    return response()->json([
                        'status'  => 200,
                        'message' => 'Alright ! Like Removed '
                    ]);
                }
            }
            else{
                return response()->json([
                    'status'  => 404,
                    'message' => 'Collection Not Found'
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
    | Increment/Decrement Collection Followers --
    |=================================================================
    */
    public function followCollection( Request $request ,  $store_code , $collection_id )
    {
        try {
            $collection = Collection::where('id' , $collection_id)->first();

            if($collection){

                $check = $collection->followers()->where('user_id' , Auth::user()->id )->exists();

                if(!$check){

                    $collection->followers()->attach(Auth::user()->id);
                    $collection->follows = $collection->follows + 1;
                    $collection->save();

                    return response()->json([
                        'status'  => 200,
                        'message' => 'You followed this collection'
                    ]);
                }
                else{
                    $collection->followers()->detach(Auth::user()->id);
                    $collection->follows = $collection->follows - 1;
                    $collection->save();

                    return response()->json([
                        'status'  => 200,
                        'message' => 'Alright ! Unfollowed '
                    ]);
                }
            }
            else{
                return response()->json([
                    'status'  => 404,
                    'message' => 'Collection Not Found'
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
    | Increment Collection Share Counter --
    |=================================================================
    */
    public function shareCollection($store_code , $collection_id)
    {
        try {
            $collection = Collection::where('id' , $collection_id)->first();

            if($collection){

                $collection->shares = $collection->shares + 1;
                $collection->save();

                return response()->json([
                    'status'  => 200,
                    'message' => 'Nice ! Thanks for Sharing'
                ]);
            }
            else{
                return response()->json([
                    'status'  => 404,
                    'message' => 'Collection Not Found'
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


}
