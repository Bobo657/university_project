<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class YearRange implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the value matches the format "XXXX - XXXX"
        return preg_match('/^\d{4} - \d{4}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be in the format of "YYYY - YYYY".';
    }

    
}
