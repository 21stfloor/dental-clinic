<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StartTimeNotLessThanEndTime implements Rule
{
    public function passes($attribute, $value)
    {
        return strtotime($value) > strtotime(request()->input('start_time'));
    }

    public function message()
    {
        return 'The start time must be less than the end time.';
    }
}
