<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanMatrix extends Model
{
    use HasFactory;
    protected $fillable = [
        'max',
        'min',
        'value',
    ];
}
