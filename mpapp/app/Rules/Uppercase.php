<?php
// “This class belongs to App → Rules folder”
//👉 Comes from Laravel’s folder structure
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

// Interface provided by Laravel
// Forces you to implement validate() method
class Uppercase implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if (strtoupper($value) !== $value) {
            $fail('The :attribute must be in uppercase.');
        }
    }
}
