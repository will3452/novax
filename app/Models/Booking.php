<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const STATUS_FINISHED = 'finished';
    const STATUS_PENDING = 'pending';
    const STATUS_CANCELLED = 'cancelled';


    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'date'=> 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function hasBooking($userid, $shopid, $status = self::STATUS_PENDING)
    {
        return self::where(
            [
                'user_id' => $userid,
                'shop_id' => $shopid,
                'status' => $status
            ]
        )->count();
    }
}
