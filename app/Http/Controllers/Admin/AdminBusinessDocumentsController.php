<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Document;

class AdminBusinessDocumentsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index()
    { 
        $documents                = Document::all();
        $documents_count          = count($documents);
        $active_documents_count   = Document::where('document_status',1)->count();
        $inactive_documents_count = Document::where('document_status',0)->count();

        return response()->json([
            'status'            => 200,
            'documents'         => $documents,
            'documents_count'   => $documents_count,
            'active_documents'  => $active_documents_count,
            'inactive_documents'=> $inactive_documents_count,
        ]);
    }



    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function documentsWithInputs()
    { 
        $documents = Document::with('inputs')->get();

        return response()->json([
            'status'    => 200,
            'documents' => $documents,
        ]);
    }



    /*
    |===================================================
    | Show the form for creating a new resource.
    |===================================================
    */
    public function create()
    {
       //
    }

    

    /*
    |====================================================
    | Store a newly created resource in storage.
    |====================================================
    */ 
    public function store(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'document_title'   => 'required|string|max:100|unique:documents,document_title',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'document_title' => $request->document_title,
            'document_status'=> $request->document_status == "on" ? 1 : 0,
        ];

        $document = new Document();
        $isSaved  = $document->create($formData);
        
        if ($isSaved) {
            return response()->json([
                "status"  => 200,
                "message" => "Document is Added Successfully",
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
    public function edit($id)
    {
        $document = Document::where('id',$id)->first();
    
        return response()->json([
            'status'   => 200,
            'document' => $document
        ]);
    }



    /* 
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make( $request->all(), [
            'document_title' => 'required|string|max:100|unique:documents,document_title,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'document_title' => $request->document_title,
            'document_status'=> $request->document_status == "on" ? 1 : 0,
        ];

        $isUpdated = Document::where('id', $id)->update($formData);
        if ($isUpdated) {
            return response()->json([
                "status"  => 200,
                "message" => "Document is Updated Successfully",
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
    public function destroy($id)
    {
        return response()->json([
            'status'  => 200,
            'message' => "got it",
        ]);

        $isDeleted = Document::where('id',$id)->delete();
        
        if ($isDeleted) {  
            return response()->json([
                "status"  => 200,
                "message" => "Business Document is Deleted Successfully",
            ]);
        }

        return response()->json([
            "status"  => 100,
            "message" => "Something Went Wrong",
        ]);
        
    }
}