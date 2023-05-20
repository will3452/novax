<?php

namespace App\Rules;

use App\Models\Inventory;
use Illuminate\Contracts\Validation\Rule;

class ValidQuantity implements Rule
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
        //get total quantity
        $out = Inventory::whereProductId(request()->product)->whereBound('OUT')->sum('qty');
        $in = Inventory::whereProductId(request()->product)->whereBound('IN')->sum('qty');

        if ($in > $out) {
            $free = $in - $out;
            if ($value > $free) {
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'error :attribute, not enough balance. please check your inventory';
    }
}
