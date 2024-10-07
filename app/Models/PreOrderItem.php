<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pre_order_id',
        'product_id',
        'price',
        'quantity',
        'payable',
    ];

    public function preOrder () {
        return $this->belongsTo(PreOrder::class, 'pre_order_id');
    }
    public function product () {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
