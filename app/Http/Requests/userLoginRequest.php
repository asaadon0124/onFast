<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userLoginRequest extends FormRequest
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
            'email'     => 'required|max:255|exists:users,email',
            'password'  => 'required|string|min:8|',
        ];
    }


    public function messages()
    {
        return
        [
            'email.required'                => ' الايميل مطلوب',
            'email.exists'                  => 'هذا الايميل غير مسجل',

            'password.required'             => 'كلمة المرور مطلوبة',
            'password.min'                  => 'كلمة المرور لا تقل عن  8 عناصر',
        ];
    }
}
