<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;
    const TYPE_TIP = 'tips';
    const TYPE_QUOTES = 'quotes';
    protected $fillable = [
        'type',
        'body',
    ];
}
