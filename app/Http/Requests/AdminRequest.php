<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name'      => ['required', Rule::unique('admins')->ignore($this->id)->whereNull('deleted_at')],
            'email'     => ['required', Rule::unique('admins')->ignore($this->id)->whereNull('deleted_at')],
            'email'     => ['required', Rule::unique('admins')->ignore($this->id)->whereNull('deleted_at')],
            'phone'     => ['required', Rule::unique('admins')->ignore($this->id)->whereNull('deleted_at')],
            'password'  => 'required|min:8',
        ];
    }

    public function messages()
    {
        return
        [
            
            'name.required'     => 'يجب ادخال اسم المدير',
            'name.unique'       => 'هذا الاسم مستخدم من قبل',

            'email.required'    => 'يجب ادخال ايميل المدير ',
            'email.email'       => 'الايميل غير صحيح',
            'email.unique'      => 'هذا الايميل مستخدم من قبل',

            'password.required' => 'يجب ادخال كلمة السر',
            'password.min'      => 'كلمة السر لا تقل عن 8 عناصر',

            'phone.required'    => 'رقم التليفون مطلوب ',
            'phone.unique'      => 'هذا الرقم مستخدم من قبل',
           
           
        ];
    }
}
