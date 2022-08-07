<?php

namespace App\Models;

use App\Models\Traits\BookingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, BookingTrait;
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

    const STATUS_FOR_REVIEW = 'FOR REVIEW';
    const STATUS_TO_PAY = 'TO PAY';
    const STATUS_BOOKED = 'BOOKED';
}
