<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user = User::where('id' , Auth::user()->id)->first();


        $activity_log = ActivityLog::where('user_id' , $user->id)->orderBy('created_at' , 'DESC')->get();

        return response()->json([
            'status' => 200,
            'activity_log' => $activity_log
        ]);



    }

    public static function add($message, $module=null, $user_id=null  , $detail = null   ){
        if($user_id){
            $user_id = $user_id;
        }
        else{
            $user = User::where('id' , Auth::user()->id)->first();
            $user_id = $user->id;

        }

        if(!$module){
            $module = 'general';
        }


        $activity_log = ActivityLog::create([
            'user_id' => $user_id,
            'module' => $module,
            'message' => $message,
            'detail'  => $detail
        ]);

        $user = User::where('id' , $user_id)->first();

        $activity_log = ActivityLog::where('user_id' , $user_id)->get();

        return $activity_log;

    }

    public function showByModule($module){
        $user = User::where('id' , Auth::user()->id)->first();


        $activity_log = ActivityLog::where(['user_id' => $user->id , 'module' => $module])->orderBy('created_at' , 'DESC')->get();

        return response()->json([
            'status' => 200,
            'activity_log' => $activity_log
        ]);
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
        //

        $activity_log = self::add($request->message, $request->module , $request->user_id , $request->detail );

        return response()->json([
            'status' => 200,
            'activity_log' => $activity_log
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

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
}
