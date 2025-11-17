<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_CONFIRMED = 'CONFIRMED';
    const STATUS_PENDING = 'PENDING';
    const STATUS_CANCELED = 'CANCELED';

    protected $fillable = [
        'employee_id',
        'status',
    ];

    public function employee () {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function orderItems () {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
