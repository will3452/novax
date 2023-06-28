<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'method',
        'pay_for_month',
        'approved_at',
        'proof',
    ];

    protected $casts = [
        'approved_at' => 'date',
        'pay_for_month' => 'date',
    ];
}
