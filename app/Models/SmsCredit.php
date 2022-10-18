<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsCredit extends Model
{
    use HasFactory;
    protected $fillable = [
        'balance',
        'total',
    ];
}
