<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class supplierRequest extends FormRequest
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
            'name'      => 'required',
            'city_id'   => 'required||exists:cities,id',
            'phone'     =>  ['required', Rule::unique('suppliers')->ignore($this->id)->whereNull('deleted_at')],
            'adress'    => 'required'
        ];
    }



    public function messages()
    {
        return
        [
            
            'name.required'     => 'يجب ادخال اسم المورد',
           

            'city_id.required'    => 'يجب اختيار اسم المدينة التابع لها المورد  ',
            // 'city_id.exists'       => 'المدينة المختارة غير موجودة',
            

            'adress.required' => 'يجب ادخال عنوان المورد',

            'phone.required'    => 'رقم التليفون مطلوب ',
            'phone.unique'      => 'هذا الرقم مستخدم من قبل',
           
           
        ];
    }
}
