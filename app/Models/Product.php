<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    const CATEGORY_SINGLE = 'Single';
    const CATEGORY_BUNDLE = 'Bundle';

    protected $fillable = [
        'name',
        'price',
        'category',
        'image',
        'default_stock',
        'current_stock',
    ];

    public function orderItems () {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
