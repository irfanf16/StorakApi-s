<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionProductsResource;
use App\Http\Resources\FeaturedUserStoreResource;
use App\Models\Collection;
use App\Models\SocialLink;
use App\Models\SocialLogin;
use App\Models\User;
use App\Models\UserStore;
use App\Models\UserStoreSocialLink;
use App\Traits\ApiDataGenerate;
use App\Traits\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class UserStoreController extends Controller
{
    use ApiHelper;
    use ApiDataGenerate;

    /*
    |=================================================================================
    | Check If Auth User Already has Collection-Store Else Create New Collection-Store
    |=================================================================================
    */
    public function store(Request $request)
    {
        try {

            $user = User::where('id', Auth::user()->id)->with('user_store')->first();

            if (!$user->user_store) {

                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:300',
//                    'code' => 'required',
                    'visibility' => 'required|integer',
                    'description' => 'max:300',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => 100,
                        'errors' => $validator->errors()->all()
                    ]);
                }

                $store_code = $this->generateRandomString(8);
                $formdata = [
                    'name' => $request->name,
                    'name_ar' =>$this->translate($request->name,'ar'),
                    'tag_line_ar' =>$this->translate($request->tag_line ?? 'Not Provided','ar'),
                    'description_ar' =>$this->translate($request->description ?? 'Not Provided','ar'),
                    'slug' =>$this->createSlug('user_stores', $request->name),
                    'tag_line' => $request->tag_line,
                    'description' => $request->description,
                    'visibility' => $request->visibility,
                    'user_id' => Auth::user()->id,
                    'code' => $store_code
                ];

                if ($request->profile) {
                    $profile = self::uploadFile($request->profile, 'public', 'user-store/profile', true);
                    $formdata['profile'] = $profile;
                }

                if ($request->cover) {
                    $cover = self::uploadFile($request->cover, 'public', 'user-store/cover', true);
                    $formdata['cover'] = $cover;
                }

                $user_store = UserStore::create($formdata);
                if ($request->social_links){
                    foreach ($request->social_links as $link) {
                        UserStoreSocialLink::create([
                            'social_link_id' => $link['social_link_id'],
                            'user_store_id' => $user_store->id,
                            'link' => $link['link'],
                        ]);
                    }
                }

                $user_store = UserStore::with('socialLink.socialMedia')
                    ->withCount('collections')
                    ->with([
                        'collections',
                        'likers:id,name,profile_image',
                        'followers:id,name,profile_image'
                    ])->where('id', $user_store->id)->first();
                $user_store = \App\Http\Resources\UserStore::make($user_store);
                return response()->json([
                    'status' => 200,
                    'imageUrl'=>request()->getHost().'/storage/social_links/',
                    'message' => "Awesome, Your Store Is Created",
                    'user_store' => $user_store
                ]);

            } else {
                return response()->json([
                    'status' => 100,
                    'message' => "Ops! Looks like you already have a Store",
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |=====================================================================
    | Update Auth-User Collection-Store Details in Database --
    |=====================================================================
    */
    public function update(Request $request)
    {
        try {
            $user = User::where('id', Auth::user()->id)->with('user_store')->first();

            if ($user->user_store) {
                $validator = Validator::make($request->all(), [
                    'name' => 'max:300',
                    'description' => 'max:300',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => 100,
                        'errors' => $validator->errors()->all()
                    ]);
                }

                $user_store = UserStore::where('id', $user->user_store->id)->first();

                if ($request->name) {
                    $user_store->name = $request->name;
                    $user_store->name_ar =$this->translate($request->name,'ar');

                }
                if ($request->tag_line) {
                    $user_store->tag_line = $request->tag_line;
                    $user_store->tag_line_ar =$this->translate($request->tag_line,'ar');

                }

                if ($request->description) {
                    $user_store->description = $request->description;
                    $user_store->description_ar =$this->translate($request->description,'ar');

                }

                if ($request->visibility) {
                    $user_store->visibility = $request->visibility;
                }

                if ($request->profile) {
                    $profile = self::uploadFile($request->profile, 'public', 'user-store/profile', false);
                    $user_store->profile = $profile;
                }

                if ($request->cover) {
                    $cover = self::uploadFile($request->cover, 'public', 'user-store/cover', false);
                    $user_store->cover = $cover;
                }

                $user_store->save();
                if ($request->social_links){
                    foreach ($request->social_links as $link) {
                        UserStoreSocialLink::updateOrCreate(
                            ['social_link_id' => $link['social_link_id'],
                                'user_store_id' => $user_store->id,
                            ]
                            , [
                            'social_link_id' => $link['social_link_id'],
                            'user_store_id' => $user_store->id,
                            'link' => $link['link'],
                        ]);

                    }
                }

                $user_store = UserStore::with('socialLink.socialMedia')
                    ->withCount('collections')
                    ->with([
                        'collections',
                        'likers:id,name,profile_image',
                        'followers:id,name,profile_image'
                    ])->where('id', $user_store->id)->first();
                $user_store = \App\Http\Resources\UserStore::make($user_store);
                return response()->json([
                    'status' => 200,
                    'imageUrl'=>request()->getHost().'/storage/social_links/',
                    'message' => "Awesome, Your Store Is Updated",
                    'user_store' => $user_store
                ]);
            } else {
                return response()->json([
                    'status' => 100,
                    'message' => "Ops! Looks like you dont have a Store",

                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |=================================================================
    | Get Auth User User-Store Statistics Details With Collections --
    |=================================================================
    */
    public function show()
    {
        try {
            $user_store = UserStore::with('socialLink.socialMedia')->where('user_id', Auth::id())
                ->withCount('collections')
                ->with([
                    'collections',
                    'likers:id,name,profile_image',
                    'followers:id,name,profile_image'
                ])
                ->first();
            if(!$user_store){
                return response()->json([
                    'status' => 100,
                    'message' => "Ops! Looks like you dont have a Store",
                ]);
            }
            $user_store = \App\Http\Resources\UserStore::make($user_store);

            return response()->json([
                'status' => 200,
                'imageUrl'=>request()->getHost().'/storage/social_links/',
                'user_store' => $user_store
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }

    function suggestions($uname)
    {
        $string_name = $uname;
        $username_parts = array_filter(explode(" ", strtolower($string_name))); //explode and lowercase name
        $username_parts = array_slice($username_parts, 0, 2); //return only first two arry part
        $part1 = (!empty($username_parts[0])) ? substr($username_parts[0], 0, 8) : ""; //cut first name to 8 letters
        $part2 = (!empty($username_parts[1])) ? substr($username_parts[1], 0, 2) : ""; //cut second name to 5 letters
        $part3 = rand(999, 9999);
        return $username = '@' . $part1 . $part2 . '.' . $part3; //str_shuffle to randomly shuffle all characters
    }

    public function nameExist($name)
    {
        try {

            $user_store_name = UserStore::where('code', $name)->exists();
            $uname = $name;
            $desired_num = 3;
            $sug = [];
            while (count($sug) < $desired_num) {
                $mut = $this->suggestions($uname);
                if (!in_array($mut, $sug) and $mut != $uname) {
                    if (!UserStore::where('code', $mut)->exists()) {
                        $sug [] = $mut;
                    }
                }
            }
            return response()->json([
                'status' => 200,
                'user_store_name' => $user_store_name,
                'suggestions' => $sug,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }

    public function socialLinks()
    {
        try {

            $social_links = SocialLink::select('id', 'title', 'logo')->where('status', 1)->get();
            return response()->json([
                'status' => 200,
                'imageUrl'=>request()->getHost().'/storage/social_links/',
                'social_links' => $social_links

            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }

    /*
    |=================================================================
    | Get User-Store Details by Store-Code --
    |=================================================================
    */
    public function getByCode(Request $request)
    {
        try {
            $store_code = $request->store_code;

            $user_store = UserStore::where('code', $store_code)
                ->withCount('collections')
                ->with([
                    'likers:id,name,profile_image',
                    'followers:id,name,profile_image'
                ])
                ->first();
            if ($user_store) {
                $user_store->views = $user_store->views + 1;
                $user_store->save();
                $user_store = \App\Http\Resources\UserStore::make($user_store);

                return response()->json([
                    'status' => 200,
                    'imageUrl'=>request()->getHost().'/storage/social_links/',
                    'user_store' => $user_store
                ]);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => "Store Not Found"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }


    /*
    |=================================================================
    | Get User-Store Collections Listing By Store Code --
    |=================================================================
    */
    public function StoreCollections(Request $request)
    {
        try {
            $store_code = $request->store_code;

            $user_store = UserStore::where('code', $store_code)
                ->withcount('collections')
                ->with([
                    'likers:id,name,profile_image',
                    'followers:id,name,profile_image'
                ])
                ->with('collections', function ($collection) {
                    $collection->where('visibility', 1) // PUBLIC
                    ->orderBy('products_count', 'DESC')
                        ->withCount('products')
                        ->with('products', function ($product) {
                            $product->select('product_id as id', 'slug','name', 'name_ar','brand_id', 'store_id', 'primary_image', 'total_reviews', 'avg_rating',)
                                ->with([
                                    'firstVariant:id,price,special_price,product_id',
                                    'brand:id,name,slug,name_ar',
                                    'store:id,store_name,store_name_ar'
                                ]);
                        });
                })
                ->first();

            if ($user_store) {

                $user_store->views = $user_store->views + 1;
                $user_store->save();
                $user_store = \App\Http\Resources\UserStore::make($user_store);

                return response()->json([
                    'status' => 200,
                    'imageUrl'=>request()->getHost().'/storage/social_links/',
                    'user_store' => $user_store
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Store Not Found"
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }
    public function StoreCollectionsBySlug(Request $request)
    {
        try {
            $store_code = $request->store_code;

            $user_store = UserStore::where('slug', $store_code)
                ->withcount('collections')
                ->with([
                    'likers:id,name,profile_image',
                    'followers:id,name,profile_image'
                ])
                ->with('collections', function ($collection) {
                    $collection->where('visibility', 1) // PUBLIC
                    ->orderBy('products_count', 'DESC')
                        ->withCount('products')
                        ->with('products', function ($product) {
                            $product->select('product_id as id', 'slug','name','name_ar' ,'brand_id', 'store_id', 'primary_image', 'total_reviews', 'avg_rating',)
                                ->with([
                                    'firstVariant:id,price,special_price,product_id',
                                    'brand:id,name,slug,name_ar',
                                    'store:id,store_name,store_name_ar'
                                ]);
                        });
                })
                ->first();

            if ($user_store) {

                $user_store->views = $user_store->views + 1;
                $user_store->save();
                $user_store = \App\Http\Resources\UserStore::make($user_store);

                return response()->json([
                    'status' => 200,
                    'imageUrl'=>request()->getHost().'/storage/social_links/',
                    'user_store' => $user_store
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Store Not Found"
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |=================================================================
    | Get Specific Collection Products Listing by Collection ID --
    |=================================================================
    */
    public function CollectionsProducts(Request $request, $store_code, $collection_id)
    {
        try {
            $store_code = $request->store_code;
            $collection = Collection::where('id', $collection_id)
                ->withCount('products')
                ->with('products', function ($product) {
                    $product->select('product_id as id', 'name','name_ar','slug', 'brand_id', 'store_id', 'primary_image', 'total_reviews', 'avg_rating',)
                        ->with([
                            'firstVariant:id,price,special_price,product_id',
                            'brand:id,name,slug,name_ar',
                            'store:id,store_name,store_name_ar'
                        ]);
                })
                ->first();

            if ($collection) {
                $collection->views = $collection->views + 1;
                $collection->save();
                $collection=CollectionProductsResource::make($collection);

                return response()->json([
                    'status' => 200,
                    'collection' => $collection
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Collection Not Found"
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }
    public function CollectionsProductsBySlugs(Request $request, $store_code, $collection_id)
    {
        try {
            $store_code = $request->store_code;
            $collection = Collection::where('slug', $collection_id)
                ->withCount('products')
                ->with('products', function ($product) {
                    $product->select('product_id as id', 'name','name_ar','slug', 'brand_id', 'store_id', 'primary_image', 'total_reviews', 'avg_rating',)
                        ->with([
                            'firstVariant:id,price,special_price,product_id',
                            'brand:id,name,slug,name_ar',
                            'store:id,store_name,store_name_ar'
                        ]);
                })
                ->first();

            if ($collection) {
                $collection->views = $collection->views + 1;
                $collection->save();

                $collection=CollectionProductsResource::make($collection);
                return response()->json([
                    'status' => 200,
                    'collection' => $collection
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Collection Not Found"
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |=================================================================
    | Generate Random String --
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

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                'message' => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }


    /*
    |======================================================================
    | Increment/Decrement User-Store Likes Count in Database By Store Code
    |======================================================================
    */
    public function likeStore($store_code)
    {
        try {
            $store = UserStore::where('code', $store_code)->first();
            if ($store) {

                $check = $store->likers()->where('user_id', Auth::user()->id)->exists();
                if (!$check) {

                    $store->likers()->attach(Auth::user()->id);
                    $store->likes = $store->likes + 1;
                    $store->save();

                    return response()->json([
                        'status' => 200,
                        'message' => 'You liked this store'
                    ]);
                } else {
                    $store->likers()->detach(Auth::user()->id);
                    $store->likes = $store->likes - 1;
                    $store->save();

                    return response()->json([
                        'status' => 200,
                        'message' => 'Alright ! Like Removed '
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Store Not Found'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message" => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |===========================================================================
    | Increment/Decrement User-Store Followers Count in Database By Store Code
    |===========================================================================
    */
    public function followStore($store_code)
    {
        try {
            $store = UserStore::where('code', $store_code)->first();

            if ($store) {
                $check = $store->followers()->where('user_id', Auth::user()->id)->exists();

                if (!$check) {

                    $store->followers()->attach(Auth::user()->id);
                    $store->follows = $store->follows + 1;
                    $store->save();

                    return response()->json([
                        'status' => 200,
                        'message' => 'You Followed this store'
                    ]);
                } else {
                    $store->followers()->detach(Auth::user()->id);
                    $store->follows = $store->follows - 1;
                    $store->save();

                    return response()->json([
                        'status' => 200,
                        'message' => 'Alright ! Unfollowed  '
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Store Not Found'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message" => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |=================================================================
    | Increment User-Store Shares Count in Database By Store Code
    |=================================================================
    */
    public function shareStore($store_code)
    {
        try {
            $store = UserStore::where('code', $store_code)->first();

            if ($store) {
                $store->shares = $store->shares + 1;
                $store->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Nice! you shared Store'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Store Not Found'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message" => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }


    /*
    |=================================================================
    | Get Listing of All Public User-Stores -- Active Public Stores
    |=================================================================
    */
    public function allStores()
    {
        try {
            $stores = UserStore::where([
                'status' => 1,
                'visibility' => 1 // PUBLIC
            ])
                ->withCount('collections')
                ->with([
                    'collections',
                    'likers:id,name,profile_image',
                    'followers:id,name,profile_image'
                ])
                ->get();

            return response()->json([
                'status' => 200,
                'stores' => $stores
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message" => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }
    public function listStores()
    {
        try {
            $stores = UserStore::where([
                'status' => 1,
                'visibility' => 1 // PUBLIC
            ])
                ->withCount('collections')
                ->with([
                    'collections',
                    'likers:id,name,profile_image',
                    'followers:id,name,profile_image'
                ])
                ->paginate(12);
            $stores=FeaturedUserStoreResource::collection($stores);
            return response()->json([
                'status' => 200,
                'stores' => $stores->response()->getData(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message" => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |=================================================================
    | Get Listing of Most Viewed Products Of User-Stores By Store Code
    |=================================================================
    */
    public function MostViewed($store_code)
    {
        try {
            $store = UserStore::where('code', $store_code)
                ->with('collections.products', function ($q) {
                    $q->orderBy('products.views', 'DESC');
                })
                ->first();

            if ($store) {
                $products = [];
                $collections = json_decode(json_encode($store->collections));
                foreach ($collections as $collection) {
                    array_push($products, $collection->products);

                }

                $products = Arr::flatten(json_decode(json_encode($products)));
                return response()->json([
                    'status' => 200,
                    'products' => $products
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Store Not Found'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "message" => "sorry, something went wrong",
                "errors" => $e->getMessage()
            ]);
        }
    }

}
