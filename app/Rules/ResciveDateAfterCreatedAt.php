<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;


class ResciveDateAfterCreatedAt implements Rule
{
   
    
protected $createdAt;

    public function __construct($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function passes($attribute, $value)
    {
        // Check if the rescive_date is equal to or after the created_at date
        return $value >= $this->createdAt;
    }

    public function message()
    {
        return 'تاريخ التسليم يجب ان يكون اليوم او بعد ذالك';
    }
    
}
