<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class servantRebortsRequest extends FormRequest
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
            'date'      => 'required',
            'date1'     => 'required',
            'date2'     => 'required',
        ];
    }
    public function messages()
    {
        return
        [
            'date.required'     => 'يجب اختيار اسم المندوب',
            'date1.required'    => 'تاريخ البداية مطلوب',
            'date2.required'    => 'تاريخ النهاية مطلوب',
        ];
    }
}
