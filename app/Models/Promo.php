<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'discount_rate',
        'expired_at',
    ];

    protected $casts = ['expired_at' => 'date'];
}
