<?php

namespace App\Models;

use App\Models\Traits\BookingTrait;
use App\Models\Traits\DiscountedTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, BookingTrait, BelongsToUserTrait, DiscountedTrait;
    protected $fillable = [
        'trip_id',
        'trip_details',
        'date',
        'user_id',
        'status',
        'discount_id',
        'discount_image_proof',
        'paid_at',
        'qty',
        'amount_payable',
    ];

    protected $with = [
        'user',
        'discount',
        'trip'
    ];

    public function trip () {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    const STATUS_FOR_REVIEW = 'FOR REVIEW';
    const STATUS_TO_PAY = 'TO PAY';
    const STATUS_BOOKED = 'BOOKED';
}
