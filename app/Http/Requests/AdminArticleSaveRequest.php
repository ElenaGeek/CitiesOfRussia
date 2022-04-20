<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminArticleSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'min:5|max:300|required',
            'description' => 'max:2000|required',
            'text' => 'required'
        ];
    }

    public function messages()
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }

//    public function attributes()
//    {
//        return [];
//    }
}
