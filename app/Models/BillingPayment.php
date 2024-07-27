<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_transaction_id',
        'amount',
        'mop',
    ];

    public function billingTransaction () {
        return $this->belongsTo(BillingTransaction::class, 'billing_transaction_id'); 
    }
}
