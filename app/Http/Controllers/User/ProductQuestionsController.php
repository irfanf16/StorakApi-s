<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Product;
use App\Models\ProductQuestion;

class ProductQuestionsController extends Controller
{
    /*
    |=================================================================
    | Get Listing of All Questions Asked By Auth-User (Buyer)
    |=================================================================
    */
    public function index()
    {
        try{
            $product_ids = ProductQuestion::where('user_id', Auth::id())
                                          ->pluck('product_id')
                                          ->unique();

            $user_questions = Product::select('id','name','slug','primary_image','brand_id')
                                    ->whereIn('id',$product_ids)
                                    ->with('brand:id,name,slug')
                                    ->with('questions', function ($q){
                                        $q->where([
                                            'status' => 1,
                                            'user_id'=> Auth::id()
                                        ]);
                                        $q->orderBy('created_at', 'desc');
                                    })
                                    ->get();

            return response()->json([
                'status'         => 200,
                'user_questions' => $user_questions,
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
    |=================================================================
    | Store A New Question Asked by Auth-User (Buyer)
    |=================================================================
    */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'product_id'       => 'required|integer',
            'customer_question'=> 'required|string|max:500',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        $formData = [
            'product_id'       => $request->product_id,
            'user_id'          => Auth::id(),
            'customer_question'=> $request->customer_question,
        ];

        try{
            $question = new ProductQuestion();
            $isSaved  = $question->create($formData);

            return response()->json([
                "status"  => 200,
                "message" => "Your question is added successfully",
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
    |=================================================================
    | Delete Auth-User Question -- Single Quesiton
    |=================================================================
    */
    public function destroy($id)
    {
        try{
            ProductQuestion::where([
                                'user_id' => Auth::id(),
                                'id'      => $id
                            ])->delete();

            return response()->json([
                'status' => 200,
                'address'=> "Your Question has been deleted successfully"
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
    |=================================================================
    | Delete Auth-User Questions -- Multiple Questions
    |=================================================================
    */
    public function deleteMultiple(Request $request)
    {
        try {
            foreach ($request->questions as $qid) {
                ProductQuestion::where([
                                    'user_id' => Auth::id(),
                                    'id'      => $qid
                                ])
                                ->delete();
            }

            return response()->json([
                'status' => 200,
                'message'=> "The selected questions have been deleted successfully",
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage()
            ]);
        }

    }



    /*
    |=================================================================
    | Delete Auth-User Questions -- All Questions
    |==================================================================
    */
    public function deleteAll()
    {
        try {
            ProductQuestion::where('user_id', Auth::id())
                            ->delete();

            return response()->json([
                'status' => 200,
                'message'=> "Your all questions have been deleted",
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status"  => 100,
                "message" => $e->getMessage()
            ]);
        }

    }

}
