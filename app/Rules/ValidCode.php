<?php

namespace App\Rules;

use App\Models\VerificationCode;
use Illuminate\Contracts\Validation\Rule;

class ValidCode implements Rule
{
    public $request;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
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
        return VerificationCode::whereCode($value)->whereRecipient($this->request->contact)->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Contact information';
    }
}
