<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\AddressType;
use App\Models\Country;
use App\Models\UserAddress;

class AddressesController extends Controller
{
    /*
    |=========================================================
    | Get List of All Auth-User Addresses
    |=========================================================
    */
    public function index()
    {
        try{
            $addresses = UserAddress::where('user_id', Auth::id())
                                    ->with('user','countryDetail','cityDetail','addressType')
                                    ->latest()
                                    ->get();

            return response()->json([
                'status'   => 200,
                'addresses'=> $addresses
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }



    /*
    |=========================================================
    | Get Countries And Cities Listing For Creating New Address
    |=========================================================
    */
    public function create()
    {
        try{
            $countries = Country::with(['cities' => function ($q) {
                                    $q->where('status', 1)
                                      ->select('id','country_id','name');
                                }])->get();

            $address_types = AddressType::where('status',1)->get();

            return response()->json([
                'status'       => 200,
                'countries'    => $countries,
                'address_types'=> $address_types
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |=========================================================
    | Store Auth-User New Address
    |=========================================================
    */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'country_id'          => 'required',
                'city_id'             => 'required',
                'address_type_id'     => 'required',
                'user_default_address'=> 'required|boolean',
                'user_zone_no'        => 'string|max:100',
                'user_street_no'      => 'string|max:100',
                'user_building_no'    => 'string|max:100',
                'user_floor_no'       => 'nullable|string|max:100',
                'user_appartment_no'  => 'nullable|string|max:100',
                'user_address'        => 'max:500'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->errors()->all()
                ]);
            }

            $formData = [
                'user_id'             => Auth::id(),
                'country_id'          => $request->country_id,
                'city_id'             => $request->city_id,
                'address_type_id'     => $request->address_type_id,
                'user_default_address'=> $request->user_default_address,
                'user_zone_no'        => $request->user_zone_no,
                'user_street_no'      => $request->user_street_no,
                'user_building_no'    => $request->user_building_no,
                'user_floor_no'       => $request->user_floor_no ?? null,
                'user_appartment_no'  => $request->user_appartment_no ?? null,
                'user_address'        => $request->user_address,
            ];

            $new_address = new UserAddress();
            $new_address->create($formData);

            return response()->json([
                'status'  => 200,
                'message' => "New address is stored successfully"
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |=========================================================
    | Edit Auth-User Address
    |=========================================================
    */
    public function edit($id)
    {
        try{
            $address = UserAddress::where('id', $id)
                                  ->with('user','countryDetail','cityDetail','addressType')
                                  ->first();

            return response()->json([
                'status' => 200,
                'address'=> $address
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |=========================================================
    | Update Auth-User Address
    |=========================================================
    */
    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'country_id'          => 'required',
                'city_id'             => 'required',
                'address_type_id'     => 'required',
                'user_default_address'=> 'required|boolean',
                'user_zone_no'        => 'string|max:100',
                'user_street_no'      => 'string|max:100',
                'user_building_no'    => 'string|max:100',
                'user_floor_no'       => 'nullable|string|max:100',
                'user_appartment_no'  => 'nullable|string|max:100',
                'user_address'        => 'max:500'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->errors()->all()
                ]);
            }

            $formData = [
                'user_id'             => Auth::id(),
                'country_id'          => $request->country_id,
                'city_id'             => $request->city_id,
                'address_type_id'     => $request->address_type_id,
                'user_default_address'=> $request->user_default_address,
                'user_zone_no'        => $request->user_zone_no,
                'user_street_no'      => $request->user_street_no,
                'user_building_no'    => $request->user_building_no,
                'user_floor_no'       => $request->user_floor_no ?? null,
                'user_appartment_no'  => $request->user_appartment_no ?? null,
                'user_address'        => $request->user_address,
            ];

            UserAddress::where('id', $id)->update($formData);

            return response()->json([
                'status'  => 200,
                'message' => "Your address is updated successfully"
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |=========================================================
    | Delete Auth-User Addresses -- Single Address
    |=========================================================
    */
    public function destroy($id)
    {
        try{
            UserAddress::where('id', $id)->delete();

            return response()->json([
                'status' => 200,
                'address'=> "Your address has been deleted successfully"
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |=====================================================================
    | Delete Auth-User Addresses -- Multiple Addresses
    |=====================================================================
    */
    public function deleteMultiple(Request $request)
    {
        try {
            UserAddress::destroy($request->address);
            return response()->json([
                'status' => 200,
                'message'=> "The selected addresses have been deleted successfully",
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage()
            ]);
        }

    }



    /*
    |=====================================================================
    | Delete Auth User Addresses -- All Addresses
    |=====================================================================
    */
    public function deleteAll()
    {
        try {
            UserAddress::where('user_id', Auth::id())
                        ->delete();

            return response()->json([
                'status' => 200,
                'message'=> "Your all addresses have been deleted",
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage()
            ]);
        }

    }


}
