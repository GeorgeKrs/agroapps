<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AllDaysOfWeekExistsRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $givenDays = array_keys($value);

        if (!empty(array_diff($days, $givenDays))) {
            $fail("All week days must be included");
        }
    }
}
