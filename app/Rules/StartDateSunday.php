<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
//use Illuminate\Contracts\Validation\ValidationRule;

class StartDateSunday implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the start date is a Sunday
        return date('N', strtotime($value)) == 7;
    }

    public function message()
    {
        return 'يجب ان يكون بداية الأسبوع يوم الأحد';
    }
}
