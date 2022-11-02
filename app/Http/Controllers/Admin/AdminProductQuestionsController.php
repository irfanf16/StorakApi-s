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

    public function questionsList(Request $request){
        // try {

            // if ($request->ajaxRequest) {

                $questions = ProductQuestion::with('productDetail:id,name,slug', 'userDetail')->whereHas('productDetail')
                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                        $query->where('customer_question', 'LIKE', '%' . $request->search . "%");
                        $query->orWhere('vendor_reply', 'LIKE', '%' . $request->search . "%");
                    })
                    ->when($request->has('from_date') && $request->filled('from_date'), function($query) use($request){
                        $query->where('created_at' , '>', $request->from_date);
                    })
                    ->when($request->has('to_date') && $request->filled('to_date'), function($query) use($request){
                        $query->where('created_at' , '<', $request->to_date);
                    })
                    ->when($request->has('status') && $request->filled('status'), function($query) use($request){
                        $query->where('status' , '=' , $request->status);
                    })
                    ->when($request->has('questions') && $request->questions == 0, function ($query) use ($request) {
                        $query->where('vendor_reply', '=', null);
                    })
                    ->when($request->has('questions') && $request->questions == 1, function ($query) use ($request) {
                        $query->where('vendor_reply', '!=', null);
                    })
                    ->paginate($request->datatable_length ?? 10);

                    $productquestions = Productquestion::all();
                    $answer_questions = $productquestions->where('vendor_reply', '!=', null)->count();
                    $pending_questions = $productquestions->where('vendor_reply', '=', null)->count();
                    $active_questions = $productquestions->where('status', 1)->count();
                    $inactive_questions = $productquestions->where('status', 0)->count();
                return response()->json([
                    'status' => 200,
                    'questions' => $questions,
                    'total_questions' => count($productquestions),
                    'answer_questions' => $answer_questions,
                    'pending_questions' => $pending_questions,
                    'active_questions' => $active_questions,
                    'inactive_questions' => $inactive_questions,
                ]);
            // }
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
        $question = ProductQuestion::where('id',$qid)->first();

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

        $isUpdated = ProductQuestion::where('id', $qid)->update($formData);

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
        $isDeleted = ProductQuestion::where('id',$qid)->delete();

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

    public function changeStatus(Request $request)
    {
        try {
            ProductQuestion::where('id', $request->question_id)->update(['status' => $request->status]);
            return response()->json(['status' => 200, 'success' => 'Status changed successfully.', 'request' => $request->all()]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
