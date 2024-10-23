<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'amount',
        'remarks',
        'date',
    ];

    protected $casts = ['date' => 'date'];
}
