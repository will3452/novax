<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    const CATEGORY_SINGLE = "Single";
    const CATEGORY_BUNDLE = "Bundle";

    protected $fillable = [
        "name",
        "price",
        "category",
        "sheet_id",
        "card_set_category",
        "search_keyword",
        "image",
        "default_stock",
        "current_stock",
        "remarks",
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, "product_id");
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class, "product_id");
    }
}
