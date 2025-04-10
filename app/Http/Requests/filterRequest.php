<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class filterRequest extends FormRequest
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
        return 
        [
            'filter' => 'required'
        ];
    }

    public function messages()
    {
        return
        [
            'filter.required'     => ' هذا الحقل مطلوب',            
        ];
    }
}
