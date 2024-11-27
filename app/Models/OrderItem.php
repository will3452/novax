<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'amount',
        'order_id',
    ];

    public function order () {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product () {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
