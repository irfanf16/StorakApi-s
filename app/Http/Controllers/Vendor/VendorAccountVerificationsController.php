<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class VendorAccountVerificationsController extends Controller
{
    /*
    |================================================================
    |  Save Email Verification Code in The Database
    |================================================================
    */
    public function saveVerifyEmailCode(Request $request)
    {
        try{
            $user = Auth::user();
            $user->email_confirmation_code = $request->confirmation_code;
            $user->save();

            return response()->json([
                'status'  => '200',
                'message' => 'Email verification code has been sent successfully',
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
    |  Send OTP to User Email Address
    |================================================================
    */
    public function sendOtp(Request $request)
    {
        $otp = $this->otp(6);

        // return view('auth.passwords.sendemailotp')->with([
        //     "otp" => $code
        // ]);

        try{
            $user = User::where('id', Auth::id())->first();
            $user->email_confirmation_code = $otp;
            $user->save();

            $sender_email = config('app.mail_from');
            $app_name = config('app.name');

            Mail::send('auth.passwords.sendemailotp', compact('otp'), function ($message) use ($user , $sender_email , $app_name) {
                $message->from( $sender_email ,  $app_name);
                $message->to($user->email, $user->name);
                $message->subject('Verify Email Address ');
                $message->priority(3);
            });

            return response()->json([
                'status'  => '200',
                'message' => 'Email verification code has been sent successfully',
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
    |  Verify User OTP Via Email Address
    |================================================================
    */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->all()
            ]);
        }
        $user = User::where("id" , Auth::user()->id)->first();

        if($user->email_confirmation_code == $request->otp){
            $user->is_email_verified       = 1;
            $user->email_confirmation_code = null;
            $user->email_verified_at       = Carbon::now();
            $user->save();

            return response()->json([
                'status'   => '200',
                'message'  => "Your email address has been verified",
                'user'     => $user,
            ]);
        }
        else{
            return response()->json([
                'status' => '100',
                'error'  => 'The OTP code does not match',
            ]);
        }


    }



    /*
    |================================================================
    |  Generate New OTP
    |================================================================
    */
    public function otp($strength)
    {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';

        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;

    }



    /*
    |================================================================
    |  Match Vendor Email Verification Code With Database Code
    |================================================================
    */
    public function matchEmailVerificationCode($code)
    {
        $user = User::where("email_confirmation_code", $code)->first();
        if (!$user){
            return response()->json([
                'status' => '100',
                'error'  => 'The link is expired or broken. Please resend email verification link',
            ]);
        }

        // UPDATE VENDOR EMAIL STATUS IN DB
        try{
            $user->is_email_verified       = 1;
            $user->email_confirmation_code = null;
            $user->email_verified_at       = Carbon::now();
            $user->save();

            return response()->json([
                'status'   => '200',
                'message'  => "Your email address has been verified",
                'user'     => $user,
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
    |  SaveVerify Vendor Mobile-Number
    |================================================================
    */
    public function verifyMobile(Request $request)
    {
        $user=Auth::user();
        if($user->mobile==$request->mobile){
        $user->is_mobile_verified=1;
        $user->save();
        return response()->json([
            'status' => '200',
            'message'   => "Successfully Verified your mobile number .",
        ]);
        }
        else{
            return response()->json([
                'status' => '100',
                'error'   => "Oops! you have enter invalid mobile number .",
            ]);
        }
    }



    /*
    |======================================================================
    | REST PASSWORD VIA MOBILE OTP VERIFICATION (1-FUNCTION )
    |======================================================================
    */

    // (1-FUNCTION TO CHECK THE VALIDATION OF MOBILE NUMBER )
    public function validateVendorMobile(Request $request)
    {
        $mobile   = $request->countryCode.$request->mobile;
        $user = User::where('mobile' , '=', $mobile)->first();

        if($user){
            return response()->json([
                'status'  => '200',
                'message' => 'Valid Phone number'
            ]);
        }
        else{
        return response()->json([
            'status' => '100',
            'message'=> 'Sorry , Invalid phone number'
        ]);
        }
    }
    // (2-FUNCTION TO CHECK THE VALIDATION OF MOBILE NUMBER )
    public function resetVendorPassword(Request $request)
    {
        $user = User::where('mobile','=',$request->mobile)->first();
        $user->password =Hash::make($request->password);
        $user->save();
        return response()->json([
            'status' => '200',
            'message'=> 'Welcome back , you have updated your password successfully'
        ]);

    }

     /*
    |======================================================================
    | REST PASSWORD VIA Email VERIFICATION (3-FUNCTION )
    |======================================================================
    */

    // (1-FUNCTION TO CHECK THE VALIDATION OF Email )
    public function validateVendorEmail(Request $request)
    {

        $email   = $request->email;
        $confirmation_code= $request->confirmation_code;
        $user = User::where('email' , '=', $email)->first();

        if($user){
            $user->email_confirmation_code = $confirmation_code;
            $user->save();
            return response()->json([
                'status'  => '200',
                'message' => 'Valid Email'
            ]);
        }
        else{
        return response()->json([
            'status' => '100',
            'message'=> 'Sorry , Invalid Email'
        ]);
        }
    }



    /*
    |===================================================================
    |  Match Password Reset Code of Email With Database Code
    |===================================================================
    */
    public function matchEmailResetCode($code)
    {
        $user = User::where("email_confirmation_code","=",$code)->first();
        if (!$user){
            return response()->json([
                'status' => '100',
                'error'  => 'Try Again please',
            ]);
        }

        // UPDATE VENDOR EMAIL STATUS IN DB
        try{
            $user->is_email_verified       = 1;
            $user->email_confirmation_code = null;
            $user->email_verified_at       = Carbon::now();
            $user->save();

            return response()->json([
                'status'  => 200,
                'message' => "Successfully Verified your Email.",
                'email'   => $user->email,
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }

    // (3-FUNCTION TO CHECK THE VALIDATION OF Email)
    public function resetVendorPasswordViaEmail(Request $request)
    {
        $user = User::where('email','=',$request->email)->first();
        if($user){
        $user->password =Hash::make($request->password);
        $user->save();
        return response()->json([
            'status' => '200',
            'message'=> 'Welcome back , you have updated your password successfully'
        ]);
        }
        return response()->json([
            'status' => '100',
            'message'=> 'Failed , Try Again Please'
        ]);


    }





}
