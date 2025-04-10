<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Http\Requests\ServantRequest;
use Illuminate\Foundation\Http\FormRequest;

class ServantRequest extends FormRequest
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
            'name'      => ['required', Rule::unique('servants')->ignore($this->id)->whereNull('deleted_at')],
            'adress'    => 'required',
            'phone'     => ['required', Rule::unique('servants')->ignore($this->id)->whereNull('deleted_at')],
            'password'  => 'required|min:8',
        ];
    }

    public function messages()
    {
        return
        [
            
            'name.required'     => 'يجب ادخال اسم المندوب',
            'name.unique'       => 'هذا الاسم المندوب من قبل',
            'adress.required'    => 'يجب ادخال عنوان المندوب ',
            'phone.required'    => 'رقم التليفون مطلوب ',
            'phone.unique'      => 'هذا الرقم مستخدم من قبل',    
        ];
    }
}
