<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'email'     => 'required|email',
            'phone'     => 'required',
            'password'  => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return
        [
            'name.required'                    => ' الاسم مطلوب',
            'email.required'                   => ' الايميل مطلوب',
            'phone.required'                     => ' التليفون  مطلوب',
            'password.required'                     => ' كلمة المرور  مطلوبة',
            'password.min'                     => ' كلمة المرور يجب ان لا تقل عن 8 عناصر',
            'password.confirmed'                     => ' كلمة المرور غير متطابقة',
          
        ];
    }
}
