<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'prediction_for',
        'interval',
        'sales_quantity',
        'stock_recommendation',
        'product_id',
    ];
}
