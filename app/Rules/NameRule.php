<?php

namespace App\Rules;

use App\Models\Profile;
use Illuminate\Contracts\Validation\Rule;

class NameRule implements Rule
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
        $exists = Profile::whereFirstName(request()->first_name)->whereMiddleName(request()->middle_name)->whereLastName(request()->last_name)->exists();


        return ! $exists;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Profile is already exists.';
    }
}
