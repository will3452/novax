<?php

namespace App\Models;

use App\Models\Traits\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory, BelongsToUserTrait;
    protected $fillable = [
        'user_id',
        'booking_id',
        'data',
        'used',
        'updated_by_id',
    ];

    public function booking () {
        return $this->belongsTo(Booking::class);
    }

    public function markAsUsed () {
        $this->update(['used' => true]);
    }

    public function updatedBy () {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
