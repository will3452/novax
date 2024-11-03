<?php

namespace App\Rules;

use App\Models\Loan;
use Illuminate\Contracts\Validation\Rule;

class CheckPaymentRule implements Rule
{
    public $loan;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $loan)
    {
        $this->loan = Loan::find($loan);
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
        return $this->loan->total_payable >= ($value + $this->loan->payments()->sum('amount'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You are paying too much.';
    }
}
