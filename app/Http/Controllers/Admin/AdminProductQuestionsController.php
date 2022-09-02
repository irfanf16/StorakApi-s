<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\ProductQuestion;

class AdminProductQuestionsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index($pid)
    {
        $questions                = ProductQuestion::where('product_id', $pid)->get();
        $questions_count          = count($questions);
        $unreplied_questions      = ProductQuestion::where(['product_id' => $pid , 'vendor_reply' => null])->count();
        $active_questions_count   = ProductQuestion::where(['product_id' => $pid , 'status' => 1])->count();
        $inactive_questions_count = ProductQuestion::where(['product_id' => $pid , 'status' => 0])->count();

        return response()->json([
            'status'             => 200,
            'questions'          => $questions,
            'questions_count'    => $questions_count,
            'unreplied_questions'=> $unreplied_questions,
            'active_questions'   => $active_questions_count,
            'inactive_questions' => $inactive_questions_count,
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
    public function store(Request $request, $pid)
    {
       //
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
    public function edit($pid, $qid)
    {
        $question = ProductsQuestion::where('id',$qid)->first();

        return response()->json([
            'status'   => 200,
            'question' => $question
        ]);
    }



    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $pid, $qid)
    {
        $validator = \Validator::make( $request->all(), [
            'question' => ['bail','required','string',Rule::unique('products_questions')->ignore($qid),'max:255'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'product_id' => $pid,
            'question'   => $request->question,
            'answer'     => $request->answer,
            'status'     => $request->status == "on" ? 1 : 0,
        ];

        $isUpdated = ProductsQuestion::where('id', $qid)->update($formData);

        if ($isUpdated) {
            return response()->json([
                "status"  => 200,
                "message" => "Product Question is Updated Successfully",
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
    public function destroy($pid, $qid)
    {
        $isDeleted = ProductsQuestion::where('id',$qid)->delete();

        if ($isDeleted) {
            return response()->json([
                "status"  => 200,
                "message" => "Product Question is Deleted Successfully",
            ]);
        }
        return response()->json([
            "status"  => 100,
            "message" => "Something Went Wrong",
        ]);

    }


}
