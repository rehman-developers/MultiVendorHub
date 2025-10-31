<?php
// app/Rules/NoProfaneWords.php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class NoProfaneWords implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->passes($attribute, $value)) {
            $fail('The :attribute contains profane words.');
        }
    }

    public function passes($attribute, $value)
    {
        $badWords = ['bad', 'word']; // Add your list
        return !Str::contains(strtolower($value), $badWords);
    }
}