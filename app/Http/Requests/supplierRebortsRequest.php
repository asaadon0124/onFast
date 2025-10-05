<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class supplierRebortsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return
        [
           'supplier_id'    => 'required|exists:suppliers,id',
            'status_id'     => 'required|exists:status,id',
            'date1'         => 'sometimes|nullable|date',
            'date2'         => 'required_with:date1|nullable|date|after_or_equal:date1',
        ];
    }
    public function messages()
    {
        return
        [
            'supplier_id.required'              => 'يجب اختيار اسم المورد',
            'status_id.required'                => 'يجب اختيار حالة الشحنة',
            'date1.date'                        => 'هذا الحقل يجب ان يكون من نوع تاريخ ',
            'date2.date'                        => 'هذا الحقل يجب ان يكون من نوع تاريخ ',
            'date2.after_or_equal'              => 'هذا التاريخ يجب ان يمون اكبر من تاريخ البداية  ',
            'date2.required_with'               => 'تاريخ نهاية المدة مطلوب',

        ];
}
}
