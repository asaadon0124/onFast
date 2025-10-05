<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRebortesRequest extends FormRequest
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
            'status'    => 'required',
            'order_num' => 'required',
        ];
    }

    public function messages()
    {
        return
        [
            'order_num.required'    => 'برجاء ادخال رقم الاوردر',
            'status.required'       => 'برجاء اختيار نوع البحث',
        ];
    }
}
