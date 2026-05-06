<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPriority implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, ['low', 'medium', 'high'])) {
            $fail('The :attribute must be low, medium, or high.');
        }
    }
}
