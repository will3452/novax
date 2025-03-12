<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelayPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id',
        'amount',
        'due_date',
        'type',
        'created_at',
    ];
    protected $casts = [
        'due_date' => 'date',
    ];
}
