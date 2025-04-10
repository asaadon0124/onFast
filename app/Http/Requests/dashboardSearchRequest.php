<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class dashboardSearchRequest extends FormRequest
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
            'governorate_id'    => 'required',
            'city_id'           => 'required',
        ];
    }

    public function messages()
    {
        return
        [
            
            'governorate_id.required'     => 'يجب اختيار نوع البحث',            
            'city_id.required'     => 'يجب ادخال قيمة البحث',
        ];
    }
}
