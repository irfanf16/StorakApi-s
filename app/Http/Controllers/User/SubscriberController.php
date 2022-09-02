<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeRequest;
use App\Models\ContactUs;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'          => 'required',
            'platform_type'          => 'required',

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }
        if (Subscriber::where('email', $request->email)->exists()) {
            return response()->json([
               'status'=>100,
               'errors'=>'You Have Already subscribe us'
            ]);
        }
        Subscriber::create(['email'=>$request->email,'platform_type'=>$request->platform_type]);
        return response()->json([
            'status'=>200,
            'message'=>'Your Have subscribe successfully'
        ]);
    }
    public function constantUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'          => 'required',
            'country_code' => 'required|string|max:4',
            'mobile' => 'required|string|min:8|max:11',
            'subject'          => 'required',
            'message'          => 'required',

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }
        ContactUs::create(['name'=>$request->name,'email'=>$request->email,'country_code'=>$request->country_code,'mobile'=>$request->mobile,'subject'=>$request->subject,'message'=>$request->message]);
        return response()->json([
            'status'=>200,
            'message'=>'Thanks for contact us we will back to you'
        ]);
    }
}
