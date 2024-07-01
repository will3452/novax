<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'reference',
        'total_amount',
        'payment_method',
        'payment_status',
        'status',
    ];

    public function orderItems () {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function customer () {
        return $this->belongsTo(User::class, 'customer_id');
    }

    const ORDER_STATUS = ['PROCESSING', 'SHIPPED', 'DELIVERED', 'CANCELLED'];
}
