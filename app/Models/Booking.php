<?php

namespace App\Models;

use App\Models\Traits\BookingTrait;
use App\Models\Traits\DiscountedTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BelongsToUserTrait;
use App\Models\Traits\TransactionableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, BookingTrait, BelongsToUserTrait, DiscountedTrait, TransactionableTrait;
    protected $casts = [
        'date' => 'date',
        'paid_at' => 'date',
    ];
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
        // additional
        'time_id',
        'member',
        'seat',
        'type',
        'bus_id',
    ];

    protected $with = [
        'user',
        'discount',
        'trip',
        'transaction',
        'bus',
    ];

    public function trip () {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    public function bus () {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function ticket () {
        return $this->hasOne(Ticket::class, 'booking_id');
    }

    const STATUS_FOR_REVIEW = 'FOR REVIEW';
    const STATUS_TO_PAY = 'TO PAY';
    const STATUS_BOOKED = 'BOOKED';
    const STATUS_CANCELLED = 'CANCELLED';

    public function approve () {
        $this->update(['status' => self::STATUS_TO_PAY]);
    }

    public function cancel () {
        $this->update(['status' => self::STATUS_CANCELLED]);
    }

    public function booked($payload = "{}") {
        $this->update(['status' => self::STATUS_BOOKED, 'paid_at' => now()]);
        $seats = explode(",", $this->seat);
        foreach ($seats as $seat) {
            SeatLogger::create([
                'time_id' => $this->time_id,
                'seat' => $seat,
                'booking_id' => $this->id,
                'bus_id' => $this->bus_id,
                'date' => $this->date,
            ]);
        }
        $this->ticket()->create([
            'user_id' => $this->user_id,
            'data' => $payload,
        ]);
    }

    public function time() {
        return $this->belongsTo(Time::class);
    }
}
