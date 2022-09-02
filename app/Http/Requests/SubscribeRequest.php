<?php

namespace App\Http\Requests;

use http\Env\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class SubscribeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required',
            'platform_type'=>'required',
        ];
    }
//    public function failedValidation(Validator $validator)
//    {
//        $errors = $validator->messages()->all();
//        return response()->json(['status'=>false,'errors'=>$errors]);
//    }
    public function messages()
    {
        return [
            'email.required' => 'A title is required',
            'platform_type.required' => 'A message is required',
        ];
    }
}
