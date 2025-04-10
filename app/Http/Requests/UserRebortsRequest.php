<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRebortsRequest extends FormRequest
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
            'status_id'     => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
        ];
    }

    public function messages()
    {
        return
        [
            'status_id.required'                    => ' الحالة مطلوبة',
            'start_date.required'                   => ' تاريخ البداية مطلوب',
            'end_date.required'                     => ' تاريخ النهاية مطلوب',
          
        ];
    }
}
