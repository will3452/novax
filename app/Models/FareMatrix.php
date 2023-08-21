<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FareMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_type',
        'from',
        'to',
        'fare',
    ];
}
