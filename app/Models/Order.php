<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'products',
        'paid_at',
        'amount_payable',
        'status',
        'hash',
        'promo', // json
    ];
    protected $casts = [
        'paid_at' => 'date',
    ];
    const STATUS_PENDING = 'Pending';
    const STATUS_TO_DELIVER = 'To Deliver';
    const STATUS_TO_RECEIVED = 'To Received';
    const STATUS_TO_PAY = 'To Pay';
    const STATUS_RECEIVED = 'Received';

    //users
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function setHash($hash) {
        return $this->update(['hash' => $hash]);
    }
}
