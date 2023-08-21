<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'bound',
        'amount',
        'user_id',
        'status',
    ];

    const STATUS_FAILED = 'FAILED';
    const STATUS_SUCCESS = 'SUCCESS';

    const BOUND_IN = 'IN';
    const BOUND_OUT = 'OUT';

    const TYPE_CASH_IN = 'CASH-IN';
    const TYPE_CASH_OUT = 'CASH-OUT';
    const TYPE_LOAD = 'LOAD';
    const TYPE_TRANSFER = 'TRANSFER';
    const TYPE_PAYMENT = 'PAYMENT';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
