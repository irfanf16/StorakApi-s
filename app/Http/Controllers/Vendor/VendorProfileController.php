<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Image;
use Carbon\Carbon;


use App\Models\User;
use App\Models\UsersAddress;
use App\Models\BusinessInformation;
use App\Models\BusinessDocument;
use App\Models\Store;
use App\Models\BankAccount;
use App\Models\WarehouseAddress;
use App\Models\ReturnAddress;
use App\Models\Category;
use App\Models\Document;
use App\Models\City;
use App\Models\VendorRequest;
use App\Models\SubRole;
use App\Traits\ApiHelper;
use Illuminate\Support\Facades\DB;

class VendorProfileController extends Controller
{
    use ApiHelper;

    /*
    |===============================================================
    | Get Vendor Profile Details
    |===============================================================
    */
    public function profileDetails()
    {
        try{
            $profile_details = User::with('addresses')
                                    ->with('businessInfo.businessDocs')
                                    ->with('businessInfo.city')
                                    ->with('store')
                                    ->with('bankAccount')
                                    ->with('store.warehouseAddress.city')
                                    ->with('store.returnAddress')
                                    ->find(Auth::user()->id);

            $categories = Category::select('id','title')
                                ->where('status',1)
                                ->orderBy('title','asc')
                                ->get();

            $documents  = Document::with('activeInputs')
                                ->select('id','document_title')
                                ->where('document_status',1)
                                ->get();

            $cities = City::select('id','name')
                            ->where('status',1)
                            ->get();

            $business_information  =  BusinessInformation::where('user_id' , Auth::user()->id)->first();
            if($business_information ){
                $business_documents = BusinessDocument::where('business_information_id' , $business_information->id )->get();

            }
            else{
                $business_documents =[];
            }
            return response()->json([
                'status'          => 200,
                'profile_details' => $profile_details,
                // 'profile_status'  => $profile_status,
                'cities'          => $cities,
                'categories'      => $categories,
                'documents'       => $documents,
                'business_document' => $business_documents
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    public function update_account(Request $request , $id){
        // dd($request->all());

        $user = User::where('id' , $id)->first();





        if($user){

            $user->name = $request->name;
            if($request->password){
                $user->password = bcrypt($request->password);

            }

            $user->save();

            $user = User::where('id' , $id)->with('Subrole')->first();



            return response()->json([
                'status' => 200,
                'user'   =>$user
            ]);

        }
        else{
            return response()->json([
                'status' => 404,
                'message' => "Vendor Not Found!"
            ]);

        }



    }




    /*
    |============================================================
    | Create / Update Basic-Information of Vendor
    |============================================================
    */
    public function basicInfoUpdate(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'name'   => 'required|string|max:100',
            // 'email'  => 'required|email|max:30|unique:users,email,'.\Auth::user()->id,
            // 'mobile' => 'required|string|max:15|unique:users,mobile,'.\Auth::user()->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        try {
            $formData = [
                'name'   => $request->name,
                // 'email'  => $request->email,
                // 'mobile' => $request->mobile,
            ];
            $isUpdated = User::where('id',Auth::user()->id)->update($formData);

            return response()->json([
                "status"  => 200,
                "message" => "User Basic Information Details Are Updated Successfully",
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
    |===============================================================
    | Create / Update Business-Information of Vendor
    |===============================================================
    */
    public function businessInfoUpdate(Request $request)
    {
        $business_info = BusinessInformation::where('user_id',Auth::id())->first();

        if (!$business_info) {
            // $validator = \Validator::make( $request->all(), [
            //     'person_id_front_image' => 'required|mimes:jpeg,png,jpg|max:1024',
            //     'person_id_back_image'  => 'required|mimes:jpeg,png,jpg|max:1024',
            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'status' => 100,
            //         'errors' => $validator->messages()->all()
            //     ]);
            // }
        }

        $validator = Validator::make( $request->all(), [
            'company_name'          => 'required|string|max:100',
            'country_id'            => 'required|integer',
            'city_id'               => 'required|integer',

            'company_zone_no'       => 'required|string|max:255',
            'company_street_no'     => 'required|string|max:255',
            'company_building_no'   => 'required|string|max:255',
            'company_floor_no'      => 'required|string|max:255',
            'company_appartment_no' => 'required|string|max:255',
            'company_address'       => 'max:1000',

            'person_incharge_name'  => 'max:100',
            'person_incharge_mobile'=> 'max:15',
            'person_incharge_email' => 'max:50',
            'person_id_type'        => 'required|integer',
            'person_id_no'          => 'required|string|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        $formData = [
            'company_name'          => $request->company_name,
            'country_id'            => $request->country_id,
            'city_id'               => $request->city_id,

            'company_zone_no'       => $request->company_zone_no,
            'company_street_no'     => $request->company_street_no,
            'company_building_no'   => $request->company_building_no,
            'company_floor_no'      => $request->company_floor_no,
            'company_appartment_no' => $request->company_appartment_no,
            'company_address'       => $request->company_address,

            'person_incharge_name'  => $request->person_incharge_name,
            'person_incharge_mobile'=> $request->person_incharge_mobile,
            'person_incharge_email' => $request->person_incharge_email,
            'person_id_type'        => $request->person_id_type,
            'person_id_no'          => $request->person_id_no,
        ];

        // ID-FRONT-IMAGE
        if ($request->person_id_front_image) {

            // $validator = \Validator::make( $request->all(), [
            //     'person_id_front_image' => 'mimes:jpeg,png,jpg|max:1024',
            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'status' => 100,
            //         'errors' => $validator->messages()->all()
            //     ]);
            // }

            if ($business_info) {
                // REMOVE ID-FRONT-IMAGES
                // if ($business_info->person_id_front_image != NULL && file_exists(public_path() . '/admin/images/businesses/id/org/' . $business_info->person_id_front_image)) {
                //     unlink(public_path() . '/admin/images/businesses/id/org/' . $business_info->person_id_front_image);
                // }
                // if ($business_info->person_id_front_image != NULL && file_exists(public_path() . '/admin/images/businesses/id/md/' . $business_info->person_id_front_image)) {
                //     unlink(public_path() . '/admin/images/businesses/id/md/' . $business_info->person_id_front_image);
                // }
            }

            // $image          = $request->person_id_front_image;
            // $imageExtension = $image->extension();
            // $currentTime    = time();
            // $imageName      = 'front'.$currentTime.'.'.$imageExtension;

            // $image       = Image::make($image->getRealPath());
            // $imagePath   = public_path('/admin/images/businesses/id/org');
            // $imageSave   = $image->save($imagePath.'/'.$imageName,100);

            // $imagePath   = public_path('/admin/images/businesses/id/md');
            // $imageResize = $image->resize(500, 325);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,100);

            $imageName = self::uploadFile($request->person_id_front_image , 'public' , 'vendor/documents/id-front');
            $formData['person_id_front_image'] = $imageName;
        }

        // ID-BACK-IMAGE
        if ($request->person_id_back_image) {

            // $validator = \Validator::make( $request->all(), [
            //     'person_id_back_image' => 'mimes:jpeg,png,jpg|max:1024',
            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'status' => 100,
            //         'errors' => $validator->messages()->all()
            //     ]);
            // }

            // if ($business_info) {
            //     // REMOVE ID-BACK-IMAGES
            //     if ($business_info->person_id_back_image != NULL && file_exists(public_path() . '/admin/images/businesses/id/org/' . $business_info->person_id_back_image)) {
            //         unlink(public_path() . '/admin/images/businesses/id/org/' . $business_info->person_id_back_image);
            //     }
            //     if ($business_info->person_id_back_image != NULL && file_exists(public_path() . '/admin/images/businesses/id/md/' . $business_info->person_id_back_image)) {
            //         unlink(public_path() . '/admin/images/businesses/id/md/' . $business_info->person_id_back_image);
            //     }
            // }

            // $image          = $request->person_id_back_image;
            // $imageExtension = $image->extension();
            // $currentTime    = time();
            // $imageName      = 'back'.$currentTime.'.'.$imageExtension;

            // $image       = Image::make($image->getRealPath());
            // $imagePath   = public_path('/admin/images/businesses/id/org');
            // $imageSave   = $image->save($imagePath.'/'.$imageName,100);

            // $imagePath   = public_path('/admin/images/businesses/id/md');
            // $imageResize = $image->resize(500, 325);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,100);

            $imageName = self::uploadFile($request->person_id_back_image , 'public' , 'vendor/documents/id-back');

            $formData['person_id_back_image'] = $imageName;
        }

        if ($business_info) {
            $isUpdated = BusinessInformation::where('id',Auth::user()->businessInfo->id)->update($formData);
            if ($isUpdated) {
                return response()->json([
                    "status"  => 200,
                    "message" => "Vendor Basic Information Details Are Updated Successfully",
                ]);
            }

            else{
                return response()->json([
                    "status"  => 100,
                    "message" => "Sorry! Something Went Wrong",
                ]);
            }
        }

        // CREATE NEW BUSINESS-INFO
        $formData['user_id'] = Auth::id();
        $createBusiness = new BusinessInformation();
        $isSaved  = $createBusiness->create($formData);

        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Vendor Store Information Details Are Completed Successfully",
            ]);
        }
        else{
            return response()->json([
                "status"  => 100,
                "message" => "Sorry! Something Went Wrong",
            ]);
        }


    }




    /*
    |===============================================================
    | Create / Update Business-Documents of Vendor
    |===============================================================
    */
    public function businessDocumentsUpdate(Request $request)
    {
        // return($request->all());
        // CHECKING IF AUTH-USER HAVE NOT COMPLETED BUSINESS-INFORMATION
        if (!(Auth::user()->businessInfo)) {
            return response()->json([
                'status'  => 100,
                'message' => "Sorry, You have not completed your business information Yet. Please Complete Business Information First."
            ]);
        }

        $documents = $request->docs;

        $business_info_id = Auth::user()->businessInfo->id;
        $business_docs    = BusinessDocument::where('business_information_id', $business_info_id)->first();

        // DOCUMENTS UPDATE -- IF BUSINESS DOCUMENTS ARE ALREADY UPLOADED
        if ($business_docs) {

            foreach ($documents as $key => $doc) {
                if ($doc) {
                    $image_name =   ApiHelper::uploadFile($doc , 'public' , 'documents' , false );

                    BusinessDocument::where([
                                        'business_information_id' => $business_info_id,
                                        'document_input_id' => $key
                                    ])
                                    ->update(['document_input_value' => $image_name]);
                }
            }
            return response()->json([
                "status"  => 200,
                "message" => "Vendor business documents are updated successfully",
            ]);
        }


        // check if doc exist
        foreach ($documents as $key => $doc) {

            if (!$doc) {
                return response()->json([
                    "status"  => 100,
                    "message" => "Please attach all the document files"
                ]);
            }
        }

        // DOCUMENTS STORE -- IF BUSINESS DOCUMENTS ARE NOTE UPLOADED YET
        foreach ($documents as $key => $doc) {


            /*
            |=========================================================================
            | STORE BUSINESS DOCUMENTS IN DATABASE -- (MULTIPLE INTERACTION WITH DB)
            |=========================================================================
            |
            |    BusinessDocument::create([
            |        'business_information_id' => $business_info_id,
            |        'document_id'             => 1,
            |        'document_input_id'       => $key,
            |        'document_input_value'    => $file_name,
            |    ]);
            |
            */

            // NOTE - IF WE USE INSERT METHOD TO STORE ARRAY IN DB WE HAVE TO SET TIME-STAMP
            $image_name =   ApiHelper::uploadFile($doc , 'public' , 'documents' , false );
            // return($image_name);

            $docs[] = [
                'business_information_id' => $business_info_id,
                'document_input_id'       => $key,
                'document_input_value'    => $image_name ?? NULL,
                'created_at'              => Carbon::now()->toDateTimeString(),
                'updated_at'              => Carbon::now()->toDateTimeString()
            ];
        }

        // STORE BUSINESS DOCUMENTS IN DATABASE -- (SINGLE INTERACTION WITH DB)
        $isSaved = BusinessDocument::insert($docs);

        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Vendor Business Documents Are Completed Successfully",
            ]);
        }
        else{
            return response()->json([
                "status"  => 100,
                "message" => "Sorry! Something Went Wrong",
            ]);
        }

    }




    /*
    |===============================================================
    | Preview Vendor Business Document
    |===============================================================
    */
    public function previewBusinessDocument($id)
    {
        try{
            $business_info_id = Auth::user()->businessInfo->id;

            $doc = BusinessDocument::where([
                                        'business_information_id' => $business_info_id,
                                        'document_input_id'       => $id,
                                    ])->first();

            return response()->json([
                "status" => 200,
                "doc"    => $doc
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
    |================================================================
    | Create / Update Store-Information of Vendor
    |================================================================
    */
    public function storeInfoUpdate(Request $request)
    {
        // $store = Store::where('user_id',\Auth::user()->id)->first();
        $store = (User::where('id', Auth::user()->id)->with('store')->first())->store;
        // if(!$store){


        // }


        if ($store) {
            // IF AUTH USER ALREADY OWNS STORE -- UPDATE STORE VALIDATION
            $validator = Validator::make( $request->all(), [
                'store_name'        => 'required|string|max:100',
                'tag_line'          => 'max:100',
                'short_description' => 'max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->errors()->all()
                ]);
            }

        }

        else{
            // IF AUTH USER DON'T OWN ANY STORE -- CREATE STORE VALIDATION
            $validator = Validator::make( $request->all(), [
                'store_name'        => 'required|string|max:100',
                'tag_line'          => 'max:100',
                'short_description' => 'max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->errors()->all()
                ]);
            }

        }

        $formData = [
            'store_name'          => $request->store_name,
            'tag_line'            => $request->tag_line,
            'category_id'         => $request->category_id,
            'short_description'   => $request->short_description,
            'detailed_description'=> $request->detailed_description,
        ];

        // HOLIDAY-MODE
        if ($request->holiday_mode == 'on') {

            $validator = Validator::make( $request->all(), [
                'holiday_start_date' => 'required|date|before_or_equal:holiday_end_date',
                'holiday_end_date'   => 'required|date|after_or_equal:holiday_end_date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->errors()->all()
                ]);
            }

            $formData['holiday_mode']       = 1;
            $formData['holiday_start_date'] = $request->holiday_start_date;
            $formData['holiday_end_date']   = $request->holiday_end_date;
        }
        else{
            $formData['holiday_mode']       = 0;
            $formData['holiday_start_date'] = "1970-01-01";
            $formData['holiday_end_date']   = "1970-01-01";
        }

        // LOGO-IMAGE
        if ($request->logo_image) {

            // $validator = \Validator::make( $request->all(), [
            //     'logo_image' => ['bail', 'mimes:jpeg,png,jpg', 'max:1024'],
            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'status' => 100,
            //         'errors' => $validator->messages()->all()
            //     ]);
            // }

            // if ($store) {
            //     // REMOVE LOGO-IMAGES
            //     if ($store->logo_image != NULL && file_exists(public_path() . '/admin/images/stores/logo/lg/' . $store->logo_image)) {
            //         unlink(public_path() . '/admin/images/stores/logo/lg/' . $store->logo_image);
            //     }
            //     if ($store->logo_image != NULL && file_exists(public_path() . '/admin/images/stores/logo/md/' . $store->logo_image)) {
            //         unlink(public_path() . '/admin/images/stores/logo/md/' . $store->logo_image);
            //     }
            // }

            // $image          = $request->logo_image;
            // $imageExtension = $image->extension();
            // $currentTime    = time();
            // $imageName      = $currentTime.'.'.$imageExtension;

            // $image       = Image::make($image->getRealPath());
            // $imagePath   = public_path('/admin/images/stores/logo/lg');
            // $imageResize = $image->resize(300, 300);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,100);

            // $imagePath   = public_path('/admin/images/stores/logo/md');
            // $imageResize = $image->resize(150, 150);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,100);

            $imageName = self::uploadFile($request->logo_image , 'public' , 'store/logo' );
            $formData['logo_image'] = $imageName;
        }

        // COVER-IMAGE
        if ($request->cover_image) {

            // $validator = \Validator::make( $request->all(), [
            //     'cover_image' => ['bail', 'mimes:jpeg,png,jpg', 'max:1024'],
            // ]);

            // if($validator->fails()){
            //     return response()->json([
            //         'status' => 100,
            //         'errors' => $validator->messages()->all()
            //     ]);
            // }

            // if ($store) {
            //     // REMOVE COVER-IMAGES
            //     if ($store->cover_image != NULL && file_exists(public_path() . '/admin/images/stores/cover/lg/' . $store->cover_image)) {
            //         unlink(public_path() . '/admin/images/stores/cover/lg/' . $store->cover_image);
            //     }

            //     if ($store->cover_image != NULL && file_exists(public_path() . '/admin/images/stores/cover/md/' . $store->cover_image)) {
            //         unlink(public_path() . '/admin/images/stores/cover/md/' . $store->cover_image);
            //     }
            // }

            // $image          = $request->cover_image;
            // $imageExtension = $image->extension();
            // $currentTime    = time();
            // $imageName      = $currentTime.'.'.$imageExtension;

            // $image       = Image::make($image->getRealPath());
            // $imagePath   = public_path('/admin/images/stores/cover/lg');
            // $imageResize = $image->resize(585, 750);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,100);

            // $imagePath   = public_path('/admin/images/stores/cover/md');
            // $imageResize = $image->resize(195, 250);
            // $imageSave   = $imageResize->save($imagePath.'/'.$imageName,100);

            $imageName = self::uploadFile($request->cover_image , 'public' , 'store/cover' );

            $formData['cover_image'] = $imageName;
        }

        if ($store) {
            $isUpdated = Store::where('id',Auth::user()->store->id)->update($formData);
            if ($isUpdated) {
                return response()->json([
                    "status"  => 200,
                    "message" => "Vendor Store Information Details Are Updated Successfully",
                ]);
            }
            else{
                return response()->json([
                    "status"  => 100,
                    "message" => "Sorry! Something Went Wrong",
                ]);
            }
        }

        // CREATE NEW STORE
        $formData['user_id'] = Auth::user()->id;
        $newStore = new Store();
        $isSaved = $store  = $newStore->create($formData);

        // dd($isSaved);
        $store->user()->attach(Auth::user()->id);

//        $user =  Auth::user();
//        if($user->role_id == 2){
//            $user = User::where('email',$request->email)->with('Subrole')->first();
//            $subrole = SubRole::where('id' , 2)->first();
//            if(StoreController::isOwner($user->id)){
//
//                $subrole->users()->attach($user->id);
//            }
//        }


        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Vendor Store Information Details Are Completed Successfully",
            ]);
        }
        else{
            return response()->json([
                "status"  => 100,
                "message" => "Sorry! Something Went Wrong",
            ]);
        }

    }





    /*
    |==================================================================
    | Create / Update Bank-Account Information of Vendor
    |==================================================================
    */
    public function bankInfoUpdate(Request $request)
    {
        // IF AUTH-USER ALREADY OWNS BANK ACCOUNT -- UPDATE-BANK-ACCOUNT
        if (Auth::user()->bankAccount) {
            $validator = Validator::make( $request->all(), [
                'account_title'   => 'required|string|max:255',
                'account_no'      => 'required|string|max:25|unique:bank_accounts,account_title,'.Auth::user()->bankAccount->id,
                'bank_name'       => 'required|string|max:255',
                'iban'            => 'required|string|max:100|unique:bank_accounts,iban,'.Auth::user()->bankAccount->id,
                'branch_code'     => 'required|string|max:100'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->errors()->all()
                ]);
            }
        }

        // IF AUTH-USER DOES NOT OWN ANY BANK ACCOUNT -- CREATE-BANK-ACCOUNT
        else{
            $validator = Validator::make( $request->all(), [
                'account_title'   => 'required|string|max:255',
                'account_no'      => 'required|string|max:25|unique:bank_accounts,account_title',
                'bank_name'       => 'required|string|max:255',
                'branch_code'     => 'required|string|max:100',
                'iban'            => 'required|string|max:100|unique:bank_accounts,iban',
                'bank_letter_doc' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 100,
                    'errors' => $validator->errors()->all()
                ]);
            }
        }

        $formData = [
            'account_title'  => $request->account_title,
            'account_no'     => $request->account_no,
            'bank_name'      => $request->bank_name,
            'branch_code'    => $request->branch_code,
            'iban'           => $request->iban,
        ];

        if (Auth::user()->bankAccount) {

            // UDPATE-BANK-ACCOUNT
            if ($request->bank_letter_doc) {
                $formData['bank_letter_doc'] = $request->bank_letter_doc;
            }

            try {
                BankAccount::where('id',Auth::user()->bankAccount->id)->update($formData);
                return response()->json([
                    "status"  => 200,
                    "message" => "Vendor Bank Account Information Details Are Updated Successfully",
                ]);
            }
            catch (\Exception $e) {
                return response()->json([
                    "status" => 100,
                    "errors" => $e->getMessage()
                ]);
            }
        }

        try{
            // CREATE-BANK-ACCOUNT
            $formData['user_id']         = Auth::user()->id;
            $formData['bank_letter_doc'] = $request->bank_letter_doc;

            $newBank = new BankAccount();
            $newBank->create($formData);

            return response()->json([
                "status"  => 200,
                "message" => "Vendor Bank Account Information Are Completed Successfully",
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
    |===================================================================
    | Create / Update Warehouse-Address Information of Vendor
    |===================================================================
    */
    public function warehouseInfoUpdate(Request $request)
    {
        // CHECKING IF AUTH-USER OWNS ANY STORE
        if (!(Auth::user()->store)) {
            return response()->json([
                'status'  => 100,
                'message' => "Sorry, You have not created any store Yet. Please Setup a Store first"
            ]);
        }

        $validator = Validator::make( $request->all(), [
            'warehouse_name'       => 'required|string|max:255',
            'warehouse_phone_no'   => 'required|string|max:15',
            'warehouse_email'      => 'required|email|max:50',
            'country_id'           => 'required|integer',
            'city_id'              => 'required|integer',
            'warehouse_address'    => 'max:500',
            'warehouse_zone_no'      => 'required|string|max:255',
            'warehouse_street_no'    => 'required|string|max:255',
            'warehouse_building_no'  => 'required|string|max:255',
            'warehouse_floor_no'     => 'required|string|max:255',
            'warehouse_appartment_no'=> 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        $formData = [
            'warehouse_name'         => $request->warehouse_name,
            'warehouse_phone_no'     => $request->warehouse_phone_no,
            'warehouse_email'        => $request->warehouse_email,
            'warehouse_address'      => $request->warehouse_address,
            'country_id'             => $request->country_id,
            'city_id'                => $request->city_id,
            'warehouse_zone_no'      => $request->warehouse_zone_no,
            'warehouse_street_no'    => $request->warehouse_street_no,
            'warehouse_building_no'  => $request->warehouse_building_no,
            'warehouse_floor_no'     => $request->warehouse_floor_no,
            'warehouse_appartment_no'=> $request->warehouse_appartment_no,
        ];

        $warehouse = WarehouseAddress::where('store_id',Auth::user()->store->id)->first();

        if ($warehouse) {
            // IF AUTH-USER STORE HAS ALREADY A WARE-HOUSE
            $isUpdated = WarehouseAddress::where('id',Auth::user()->store->warehouseAddress->id)->update($formData);
            if ($isUpdated) {
                return response()->json([
                    "status"  => 200,
                    "message" => "Vendor Store's Warehouse Details Are Updated Successfully",
                ]);
            }
            else{
                return response()->json([
                    "status"  => 100,
                    "message" => "Sorry! Something Went Wrong",
                ]);
            }
        }

        // CREATE WAREHOUSE FOR VENDOR STORE
        $formData['store_id'] = Auth::user()->store->id;
        $new_warehouse        = new WarehouseAddress();
        $isSaved              = $new_warehouse->create($formData);

        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Vendor Store's Warehouse Details Are Completed Successfully",
            ]);
        }
        else{
            return response()->json([
                "status"  => 100,
                "message" => "Sorry! Something Went Wrong",
            ]);
        }

    }





    /*
    |===================================================================
    | Create / Update Return-Address Information of Vendor
    |===================================================================
    */
    public function returnInfoUpdate(Request $request)
    {
        // CHECKING IF AUTH-USER OWNS ANY STORE
        if (!(Auth::user()->store)) {
            return response()->json([
                'status'  => 100,
                'message' => "Sorry, You have not created any store Yet. Please Setup a Store first"
            ]);
        }

        $validator = Validator::make( $request->all(), [
            'warehouse_name'       => 'required|string|max:255',
            'warehouse_phone_no'   => 'required|string|max:15',
            'warehouse_email'      => 'required|email|max:50',
            'country_id'           => 'required|integer',
            'city_id'              => 'required|integer',
            'warehouse_address'    => 'max:500',
            'warehouse_zone_no'      => 'required|string|max:255',
            'warehouse_street_no'    => 'required|string|max:255',
            'warehouse_building_no'  => 'required|string|max:255',
            'warehouse_floor_no'     => 'required|string|max:255',
            'warehouse_appartment_no'=> 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        $formData = [
            'warehouse_name'         => $request->warehouse_name,
            'warehouse_phone_no'     => $request->warehouse_phone_no,
            'warehouse_email'        => $request->warehouse_email,
            'warehouse_address'      => $request->warehouse_address,
            'country_id'             => $request->country_id,
            'city_id'                => $request->city_id,
            'warehouse_zone_no'      => $request->warehouse_zone_no,
            'warehouse_street_no'    => $request->warehouse_street_no,
            'warehouse_building_no'  => $request->warehouse_building_no,
            'warehouse_floor_no'     => $request->warehouse_floor_no,
            'warehouse_appartment_no'=> $request->warehouse_appartment_no,
        ];

        $warehouse = ReturnAddress::where('store_id',Auth::user()->store->id)->first();

        if ($warehouse) {
            // IF AUTH-USER STORE HAS ALREADY A RETRUN ADDRESS
            $isUpdated = ReturnAddress::where('id',Auth::user()->store->returnAddress->id)->update($formData);
            if ($isUpdated) {
                return response()->json([
                    "status"  => 200,
                    "message" => "Vendor Store's Return Address Details Are Updated Successfully",
                ]);
            }
            else{
                return response()->json([
                    "status"  => 100,
                    "message" => "Sorry! Something Went Wrong",
                ]);
            }
        }

        // CREATE RETURN ADDRESS FOR VENDOR STORE
        $formData['store_id'] = Auth::user()->store->id;
        $new_warehouse        = new ReturnAddress();
        $isSaved              = $new_warehouse->create($formData);

        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Vendor Store's Return Address Details Are Completed Successfully",
            ]);
        }
        else{
            return response()->json([
                "status"  => 100,
                "message" => "Sorry! Something Went Wrong",
            ]);
        }

    }






    /*
    |===========================================================================
    | Submit Vendor Profile Information For Review Request
    |===========================================================================
    */
    public function requestProfileApproval(Request $request)
    {
        // CHECKING DATA FOR PROFILE INFORMATION COMPLETION
        if (!(BusinessInformation::where('user_id',Auth::id())->first())) {
            return response()->json([
                'status'  => 100,
                'message' => "Please Complete Your Business Information First In Order to Submit Your Profile Review Request",
            ]);
        }

        if (!(BusinessDocument::where('business_information_id', Auth::user()->businessInfo->id)->first())) {
            return response()->json([
                'status'  => 100,
                'message' => "Please Upload Your Business Documents First In Order to Submit Your Profile Review Request",
            ]);
        }

        if (!(Store::where('user_id',Auth::user()->id)->first())) {
            return response()->json([
                'status'  => 100,
                'message' => "Please Complete Your Store Information First In Order to Submit Your Profile Review Request",
            ]);
        }

        if (!(BankAccount::where('user_id',Auth::user()->id)->first())) {
            return response()->json([
                'status'  => 100,
                'message' => "Please Complete Your Bank Account Information First In Order to Submit Your Profile Review Request",
            ]);
        }

        if (!(WarehouseAddress::where('store_id',Auth::user()->store->id)->first())) {
            return response()->json([
                'status'  => 100,
                'message' => "Please Complete Your Warehouse Address Information First In Order to Submit Your Profile Review Request",
            ]);
        }

        if (!(ReturnAddress::where('store_id',Auth::user()->store->id)->first())) {
            return response()->json([
                'status'  => 100,
                'message' => "Please Complete Your Warehouse Return Address Information First In Order to Submit Your Profile Review Request",
            ]);
        }


        // CHECKING IF VENDOR HAS ALREADY SUBMITTED THE REVIEW REQUEST
        $is_already_requested = VendorRequest::where(['user_id' => Auth::id(), 'is_reviewed' => 0])->first();

        if ($is_already_requested) {
            return response()->json([
                'status'  => 100,
                'message' => "Your have already submitted a Review Request.",
            ]);
        }

        DB::beginTransaction();
        try {
            $vendor_request              = new VendorRequest();
            $vendor_request->user_id     = Auth::id();
            $vendor_request->is_reviewed = 0;
            $vendor_request->save();

            // Update Vendor Profile Status -- Under Review
            User::where('id',Auth::id())->update(['vendor_profile_status' => 1]);

            DB::commit();

            return response()->json([
                'status'  => 200,
                'message' => "Your Request has been successfully submitted.",
            ]);

        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }





    /*
    |===========================================================================
    | Display a listing of the active documents along with its active inputs
    |===========================================================================
    */
    public function documentsWithInputs()
    {
        $documents = Document::with('activeInputs')->where('document_status',1)->get();

        return response()->json([
            'status'    => 200,
            'documents' => $documents,
        ]);
    }


}
