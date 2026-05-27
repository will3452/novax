<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockoutLog extends Model
{
    protected $fillable = [
        'product_id',
        'stockout',
        'date',
    ];
}