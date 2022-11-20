<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "category",
        "product_id",
        "description",
        "image",
        "uom",
        "quantity",
        "unit_cost",
        "product_cost",
        "selling_price",
        "user_id",
    ];

    const CATEGORY_NONFOOD = 'NON-FOOD';
    const CATEGORY_FOOD = 'FOOD';

    public function user () {
        return $this->belongsTo(User::class);
    }
}
