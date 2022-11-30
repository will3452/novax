<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    const TYPE_INCOME = 'Income';
    const TYPE_EXPENSES = 'Expenses';
}
