<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'status',
    ];

    const STATUS_OTW = 'OTW';
    const STATUS_PENDING = 'PENDING';
    const STATUS_DONE = 'DONE';

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function order () {
        return $this->belongsTo(Order::class);
    }
}
