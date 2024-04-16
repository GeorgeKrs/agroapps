<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueOrderValuesRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $orderValues = array_map(function ($openHours) {
            return $openHours['order'];
        }, $value);

        if (count($orderValues) !== count(array_unique($orderValues))) {
            $fail("Order numbers must be unique and positive");
        };
    }
}
