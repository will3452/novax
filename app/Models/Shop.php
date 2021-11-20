<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    const STATUS_OPEN = 'open';
    const STATUS_CLOSED = 'closed';

    use HasFactory;
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function getCleanLogoAttribute()
    {
        $logo = explode('\\', $this->logo);

        return end($logo);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'shop_id');
    }
}
