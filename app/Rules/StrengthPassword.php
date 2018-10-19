<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrengthPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
      if ( ! $value) {
        return false;
      }
      // Here we use regular expressions for the validations.
      $uppercase          = preg_match('@[A-Z]@', $value);
      $lowercase          = preg_match('@[a-z]@', $value);
      $number             = preg_match('@[0-9]@', $value);
      $length             = strlen($value) >= 8;

      $success = true;

      // If none of this conditions are present the success is false.
      if ( ! $uppercase || ! $lowercase || ! $number || ! $length) {
        $success = false;
      }
      // Otherwise return $success
      return $success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    // Message to show the user what it's needed in order to pass the validations.
    public function message()
    {
        return 'The :attribute must have 8 characters, a number, a capital letter and a lowercase letter';
    }
}
