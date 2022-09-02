<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Document;
use App\Models\DocumentInput;

class AdminBusinessDocumentInputsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index($did)
    { 
        $document_inputs                = DocumentInput::where('document_id',$did)->get();
        $document_inputs_count          = count($document_inputs);
        $active_document_inputs_count   = DocumentInput::where(['document_id' => $did, 'input_status' => 1])->count();
        $inactive_document_inputs_count = DocumentInput::where(['document_id' => $did, 'input_status' => 0])->count();

        return response()->json([
            'status'                        => 200,
            'document_inputs'               => $document_inputs,
            'document_inputs_count'         => $document_inputs_count,
            'active_document_inputs_count'  => $active_document_inputs_count,
            'inactive_document_inputs_count'=> $inactive_document_inputs_count,
        ]);
    }



    /*
    |===================================================
    | Show the form for creating a new resource.
    |===================================================
    */
    public function create($did)
    {
        $business_documents = Document::select('id','document_title')
                                      ->where('document_status',1)
                                      ->get();

        return response()->json([
            'status'            => 200,
            'business_documents'=> $business_documents,
        ]);
    }

    

    /*
    |====================================================
    | Store a newly created resource in storage.
    |====================================================
    */ 
    public function store(Request $request, $did)
    {
        $validator = \Validator::make( $request->all(), [
            'input_name' => 'required|string|max:100',
            'input_type' => 'required|string|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'document_id' => $did,
            'input_name'  => $request->input_name,
            'input_type'  => $request->input_type,
            'input_status'=> $request->input_status == "on" ? 1 : 0,
        ];

        $documentInput = new DocumentInput();
        $isSaved       = $documentInput->create($formData);
        
        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Document Input is Added Successfully",
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
    |==================================================
    | Display the specified resource.
    |==================================================
    */
    public function show($id)
    {
        //
    }



    /* 
    |==========================================================
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($did, $id)
    {
        $document_input = DocumentInput::where('id',$id)->first();
    
        return response()->json([
            'status'        => 200,
            'document_input'=> $document_input
        ]);
    }



    /* 
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $did, $id)
    {
        $validator = \Validator::make( $request->all(), [
            'input_name' => 'required|string|max:100',
            'input_type' => 'required|string|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'document_id' => $did,
            'input_name'  => $request->input_name,
            'input_type'  => $request->input_type,
            'input_status'=> $request->input_status == "on" ? 1 : 0,
        ];

        $isUpdated = DocumentInput::where('id', $id)->update($formData);
        if ($isUpdated) {
            return response()->json([
                "status"  => 200,
                "message" => "Business Document Input Records Are Updated Successfully",
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
    |====================================================
    | Remove the specified resource from storage.
    |====================================================
    */
    public function destroy($did, $id)
    {
        $isDeleted = DocumentInput::where('id',$id)->delete();
        if ($isDeleted) {  
            return response()->json([
                "status"  => 200,
                "message" => "Business Document Input is Deleted Successfully",
            ]);
        }

        return response()->json([
            "status"  => 100,
            "message" => "Something Went Wrong",
        ]);
        
    }
}