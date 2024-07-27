<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'total_amount',
        'status', // PENDING, DONE, CANCELLED
        'mop', // EWALLET, BANK, CASHIER
        'pop', 
        'user_id', 
    ];
}
