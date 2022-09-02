<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


use App\Models\Store;
use App\Models\ProductQuestion;


class VendorProductQuestionsController extends Controller
{
    /*
    |==================================================================
    | Get Listing of All Questions Asked From Auth Vendor
    |==================================================================
    */
    public function index(Request $request)
    {
        try{
            if ($request->ajaxRequest){

                $product_ids=Product::where('store_id',Store::where('user_id', \Auth::id())->first()->id)->pluck('id');
                $questions=ProductQuestion::with('productDetail')->whereIn('product_id',$product_ids)->where('status',1)
                    ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                        $query->where('customer_question', 'LIKE', '%' . $request->search . "%");
                        $query->orWhere('vendor_reply', 'LIKE', '%' . $request->search . "%");
                    })
                    ->when($request->has('reviews') && $request->reviews==0, function ($query) use ($request) {
                        $query->where('vendor_reply','=',null);
                    })
                    ->when($request->has('reviews') && $request->reviews==1, function ($query) use ($request) {
                        $query->where('vendor_reply','!=',null);
                    })
                    ->paginate($request->datatable_length ?? 10);

                return response()->json([
                    'status' => 200,
                    'questions' => $questions,
                ]);
            }
            $product_ids=Product::where('store_id',Store::where('user_id', \Auth::id())->first()->id)->pluck('id');
            $questions=ProductQuestion::whereIn('product_id',$product_ids)->where('status',1)->get();
            $answer_questions=$questions->where('vendor_reply','!=',null)->count();
            $pending_questions=$questions->where('vendor_reply','=',null)->count();
            return response()->json([
                'status' => 200,
                'total_questions' => count($questions),
                'answer_questions' => $answer_questions,
                'pending_questions' => $pending_questions
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
    |==============================================================
    | Store Vendor Reply For Customer Question About Product
    |==============================================================
    */
    public function replyQuestion(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'question_id'  => 'required|integer',
            'vendor_reply' => 'required|string|max:500',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->messages()->all()
            ]);
        }

        $formData = [
            'vendor_reply'=> $request->vendor_reply,
        ];

        try{
            ProductQuestion::where('id', $request->question_id)
                            ->update($formData);

            // SEND PUSH-NOTIFICATION TO CUSTOMER
            // Write code here

            return response()->json([
                'status'  => 200,
                'message' => "Your reply has been submitted successfully",
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }
    public function productQuestions($pid)
    {
        $questions = ProductQuestion::with('productDetail:id,name,primary_image')
            ->where('product_id',$pid)
            ->get();
        $questions_count=count($questions);
        $answer_questions   = ProductQuestion::where(['product_id' => $pid , 'status' => 1])->where('vendor_reply', '!=', null)->count();
        $pending_questions = ProductQuestion::where(['product_id' => $pid , 'status' => 1])->where('vendor_reply', '=', null)->count();
        return response()->json([
            'status'      => 200,
            'questions' => $questions,
            'total_questions' => $questions_count,
            'answer_questions' => $answer_questions,
            'pending_questions' => $pending_questions
        ]);
    }


}
