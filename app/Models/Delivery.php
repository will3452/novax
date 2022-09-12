<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'status',
        'remarks',
        'address',
    ];
    const STATUS_PENDING = 'Pending';
    const STATUS_DELIVERED = 'Delivered';

    public function order () {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); // delivery boi
    }
}
