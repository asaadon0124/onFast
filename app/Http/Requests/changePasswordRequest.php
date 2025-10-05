<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changePasswordRequest extends FormRequest
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
            'old_password'      => 'required|min:8',
            'new_password'      => 'required|min:8',
            'confirm_password'  => 'required|same:new_password',
        ];
    }


    public function messages()
    {
        return
        [
            
            'old_password.required'     => 'يجب ادخال كلمة السر القديمة',
            'new_password.required'     => 'يجب ادخال كلمة السر الجديدة',
            'confirm_password.required' => 'يجب تاكيد كلمة السر الجديدة',
            
            'old_password.min'          => 'كلمة السر لا تقل عن 8 عناصر',
            'new_password.min'          => 'كلمة السر لا تقل عن 8 عناصر',
            'confirm_password.same'     => 'هذه البيانات غير مطابقة لكلمة السر الجديدة',
             
        ];
    }
}
