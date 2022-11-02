<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\City;
use App\Models\Document;
use App\Models\User;
use App\Models\VendorRequest;


class AdminVendorsController extends Controller
{
    private function vendors($profileStatus = null)
    {


        $vendors =  User::where([
            'role_id' => 2,
        ])
            ->when($profileStatus, function ($query) use ($profileStatus) {
                // $profileStatus = $profileStatus == 4  ? 0 : $profileStatus ;
                $profileStatus == 4  ? $profileStatus = 0 : $profileStatus;
                $query->where('vendor_profile_status', $profileStatus);
            })->get();
        $total_vendors_count = count($vendors);
        $incomplete_vendors_count = User::where('vendor_profile_status', 0)->count();
        $under_review_vendors_count = User::where('vendor_profile_status', 1)->count();
        $approved_vendors_count = User::where('vendor_profile_status', 2)->count();
        $rejected_vendors_count = User::where('vendor_profile_status', 3)->count();
        $data = [
            'total_vendors_count' => $total_vendors_count,
            'incomplete_vendors_count' => $incomplete_vendors_count,
            'under_review_vendors_count' => $under_review_vendors_count,
            'approved_vendors_count' => $approved_vendors_count,
            'rejected_vendors_count' => $rejected_vendors_count,
            'vendors' => $vendors,
        ];
        return $data;
    }

    public function allVendors(Request $request)
    {

        $vendors = User::where('role_id', 2)
        ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . "%");
            $query->orWhere('email', 'LIKE', '%' . $request->search . "%");
            $query->orWhere('country_code', 'LIKE', '%' . $request->search . "%");
            $query->orWhere('mobile', 'LIKE', '%' . $request->search . "%");
        })
        ->when($request->has('status') && $request->filled('status'), function ($query) use ($request) {
            $query->where('status', '=', $request->status);
        })
        ->when($request->has('profile_status') && $request->filled('profile_status'), function ($query) use ($request) {
            $query->where('vendor_profile_status', '=', $request->profile_status);
        })
        ->when($request->has('from_date') && $request->filled('from_date'), function ($query) use ($request) {
            $query->where('created_at', '>=', $request->from_date);
        })
        ->when($request->has('from_to') && $request->filled('from_to'), function ($query) use ($request) {
            $query->where('created_at', '<=', $request->from_to);
        })
        ->latest()
        ->paginate($request->datatable_length);
        $vendor_counts = $this->vendors();
    return response()->json([
        'status' => 200,
        'vendors' => $vendors,
        'vendor_counts' => $vendor_counts
    ]);

        // try {
        //     $vendors = $this->vendors();
        //     return response()->json([
        //         'status'  => 200,
        //         'vendors' => $vendors,
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "status" => 100,
        //         "errors" => $e->getMessage()
        //     ]);
        // }
    }
    /*
    |==============================================================
    | Get Listing of Incomplete-Vendor-Profiles
    |==============================================================
    */
    public function incompleteVendors()
    {
        try {
            $incomplete_vendors = $this->vendors(4);

            return response()->json([
                'status'  => 200,
                'incomplete_vendors' => $incomplete_vendors,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |======================================================================
    |  Get Listing of Vendor-Request (To Storak-Admin) For Profile-Review
    |======================================================================
    */
    public function underReviewVendors()
    {
        try {
            $under_review_vendors = $this->vendors(1);
            return response()->json([
                'status'               => 200,
                'under_review_vendors' => $under_review_vendors,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |==============================================================
    | Get Listing of Approved-Vendors-Profiles
    |==============================================================
    */
    public function approvedVendors()
    {
        try {
            $approved_vendors = $this->vendors(2);

            return response()->json([
                'status'  => 200,
                'approved_vendors' => $approved_vendors,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }




    /*
    |==============================================================
    | Get Listing of Rejected-Vendor-Profiles
    |==============================================================
    */
    public function rejectedVendors()
    {
        try {
            $rejected_vendors =  $this->vendors(3);

            return response()->json([
                'status'  => 200,
                'rejected_vendors' => $rejected_vendors,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |==============================================================
    | Get Incomplete Vendor Profile Details
    |==============================================================
    */
    public function incompleteVendorDetail($id)
    {
        try {
            $profile_detail = User::with('addresses')
                ->with('businessInfo.businessDocs')
                ->with('businessInfo.city')
                ->with('store')
                ->with('bankAccount')
                ->with('store.warehouseAddress.city')
                ->with('store.returnAddress')
                ->find($id);

            return response()->json([
                'status'          => 200,
                'profile_detail' => $profile_detail,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |===============================================================
    | Get Vendor Profile Details --
    |===============================================================
    */
    public function vendorProfileDetail($id)
    {
        try {
            $profile_details = User::with('addresses')
                ->with('businessInfo.businessDocs')
                ->with('businessInfo.city')
                ->with('store')
                ->with('bankAccount')
                ->with('store.warehouseAddress.city')
                ->with('store.returnAddress')
                ->find($id);

            $vendor_request_details = VendorRequest::where([
                'user_id' => $id,
                'is_reviewed' => 0,
            ])->first();

            $categories = Category::select('id', 'title')
                ->where('status', 1)
                ->orderBy('title', 'asc')
                ->get();

            $documents  = Document::with('activeInputs')
                ->select('id', 'document_title')
                ->where('document_status', 1)
                ->get();

            $cities = City::select('id', 'name')
                ->where('status', 1)
                ->get();

            return response()->json([
                'status'          => 200,
                'profile_details' => $profile_details,
                'vendor_request'  => $vendor_request_details,
                'cities'          => $cities,
                'categories'      => $categories,
                'documents'       => $documents,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }



    /*
    |==============================================================
    | Update Vendor Profile Status
    |==============================================================
    */
    public function updateVendorStatus(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            User::where('id', $id)
                ->update(['vendor_profile_status' => $request->vendor_profile_status]);

            VendorRequest::where('id', $request->vendor_request_id)
                ->update([
                    'is_reviewed' => 1,
                    'review_note' => $request->review_note
                ]);
            DB::commit();


            ActivityController::add('Your profile has been Reviewed', 'profile', $id);


            if ($request->vendor_profile_status == 1) {
                ActivityController::add('Your profile has been verified', 'profile', $id);
            } else {
                ActivityController::add('Your profile has been Rejected!', 'profile', $id, $request->review_note);
            }

            return response()->json([
                'status'  => 200,
                'message' => "Vendor profile is reviewed successfully",
            ]);
        } catch (\Exception $e) {

            DB::rollback();
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }
}
