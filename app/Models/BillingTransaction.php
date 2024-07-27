<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'particulars', 
        'user_id',
        'reference',
        'total_amount',
        'payable', 
    ];
}
