<?php

namespace App\Models\Traits;

use App\Models\Transaction;

trait TransactionableTrait
{
    public function transaction () {
        return $this->morphOne(Transaction::class, 'model');
    }
}
