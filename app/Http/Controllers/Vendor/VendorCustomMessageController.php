<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;

use App\Models\customMessage;
use Illuminate\Http\Request;

class VendorCustomMessageController extends Controller
{
    /**
     *=======================================================
     *  Listing Of Custom Messages
     * ======================================================
     */
    public function index()
    {

      $customMessages = customMessage::all();

      if($customMessages){

        return response()->json([
          'status'   => '200',
          'messages' => $customMessages
        ]);
      }
      else{

        return response()->json([
            'status'   => '100',
            'messages' => 'Record Not Found'
          ]);
      }

    }

     /*
    |====================================================
    | Create New Message .
    |====================================================
    */
    public function create()
    {
        //
    }

     /*
    |====================================================
    | Store Custom Message
    |====================================================
    */
    public function store(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'title'               => 'required|min:5|max:55',
            'message'             => 'required|min:10|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $customMessage = new customMessage();
        $customMessage->title = $request->title;
        $customMessage->message = $request->message;
        $customMessage->save();

        return response()->json([
            'status'   => '200',
            'messages' => 'Successfully save the message .'
          ]);
    }

     /*
    |====================================================
    | Show Custom Message
    |====================================================
    */
    public function show(customMessage $customMessage)
    {
        //
    }

     /*
    |====================================================
    | Edit Custom Message
    |====================================================
    */
    public function edit($id)
    {
      $customMessage= customMessage::findorfail($id);

      return response()->json([
        'status'   => '200',
        'message' => $customMessage,
      ]);

    }

     /*
    |====================================================
    | Update Custom Message
    |====================================================
    */
    public function update(Request $request, $id)
    {
        return response()->json([
            'status'   => '200',
            'message' => $request->all(),
          ]);
        $validator = \Validator::make( $request->all(), [
            'title'   => 'required|min:5|max:55',
            'message' => 'required|min:10|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $customMessage = customMessage::find($id);
        $customMessage -> title = $request->title;
        $customMessage -> message = $request->message;
        $customMessage ->save();

        return response()->json([
            'status'   => '200',
            'messages' => 'Successfully save the message .'
          ]);
    }

    /*
    |====================================================
    | Delete Custom Message
    |====================================================
    */
    public function destroy(customMessage $customMessage)
    {
        //
    }
}
