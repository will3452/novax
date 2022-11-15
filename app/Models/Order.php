<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref',
        'user_id',
        'items',
        'status',
        'discount_id',
        'mop',
        'paid_at',
        'delivery_fee',
        'amount_payable',
    ];

    const STATUS_FOR_DELIVERY = 'FOR_DELIVERY';
    const STATUS_PENDING = 'PENDING';
    const STATUS_DONE = 'DONE';

    const MOP_COD = 'COD';
    const MOP_GCASH = 'GCASH';

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function discount() {
        return $this->belongsTo(Discount::class);
    }

    public function orderItems () {
        return $this->hasMany(Item::class, 'order_id');
    }

    public function delivery() {
        return $this->hasOne(Delivery::class);
    }

    protected $casts = ['paid_at' => 'date'];
}
