<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class create_productRequest extends FormRequest
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
            'resever_name'      => 'required',
            'resver_phone'      => 'required',
            'city_id'           => 'required|exists:cities,id',
            'adress'            => 'required',
            'product_price'     => 'required',
            'shipping_price'    => 'required',
            'total_price'       => 'required',
            'rescive_date'      => 'required_with:created_at|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return
        [

            'resever_name.required'             => 'يجب ادخال اسم المستلم',
            'city_id.required'                  => 'يجب اختيار المدينة',
            'adress.required'                   => 'يجب ادخال عنوان المستلم ',
            'product_price.required'    => 'يجب ادخال سعر الشحنة ',
            'total_price.required'      => 'يجب ادخال اجمالي سعر الشحنة ',
            'shipping_price.required'   => 'يجب ادخال سعر الشحن ',
            'resver_phone.required'     => 'رقم التليفون مطلوب ',
            'rescive_date.required_with'        => 'تاريخ التسليم مطلوب ',
            'rescive_date.after_or_equal'       => 'تاريخ التسليم يساوي او بعد تاريخ اليوم ',
        ];
    }
}
