<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function order () {
        return $this->belongsTo(Order::class); 
    }

    public function product () {
        return $this->belongsTo(Product::class); 
    }

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_amount',
        'payment_method',
        'payment_status',
        'shipping_address',
        'shipping_city',
        'shipping_province',
        'shipping_postal',
        'shipping_country',
        'shipping_method',
        'shipping_cost',
        'shipping_tracking_number',
        'shipping_status',
        'discount_code',
        'discount_amount',
        'tax_rate',
        'tax_amount', 
    ];

    const PAYMENT_STATUS = ["PENDING", "PAID", "FAILED"]; 
}
