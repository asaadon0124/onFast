<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class productsRequest extends FormRequest
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
            'supplier_id'       => 'required|exists:suppliers,id',
            'city_id'           => 'required|exists:cities,id',
            'adress'            => 'required',
            'product_price'     => 'required',
            'total_price'       => 'required',
            'shipping_price'    => 'required',
            'notes'             => 'nullable',
            'rescive_date'      => 'required',
        ];
    }

    public function messages()
    {
        return
        [

            'name.required'             => 'يجب ادخال اسم المستلم',
            'supplier_id.required'      => 'يجب اختيار اسم المورد',
            'city_id.required'          => 'يجب اختيار المدينة',
            'status_id.required'        => 'يجب اختيار حالة الشحنة',
            'adress.required'           => 'يجب ادخال عنوان المستلم ',
            'product_price.required'    => 'يجب ادخال سعر الشحنة ',
            'total_price.required'      => 'يجب ادخال اجمالي سعر الشحنة ',
            'shipping_price.required'   => 'يجب ادخال سعر الشحن ',
            'resver_phone.required'     => 'رقم التليفون مطلوب ',
            'rescive_date.required'     => 'تاريخ التسليم مطلوب ',
        ];
    }
}
