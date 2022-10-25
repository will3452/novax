<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'bound',
        'amount',
        'purpose',
        'status',
        'from_id',
    ];

    const STATUS_DONE = 'DONE';
    const STATUS_PENDING = 'PENDING';
    const STATUS_CANCELLED = 'CANCELLED';

    const TYPE_TRANSFER = 'TRANSFER';
    const TYPE_LOAD = 'LOAD';
    const TYPE_PAY = 'PAY';
    const TYPE_REFUND = 'REFUND';

    const BOUND_IN = 'IN';
    const BOUND_OUT = 'OUT';

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function from () {
        return $this->belongsTo(User::class, 'from_id');
    }

}
