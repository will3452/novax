<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'slot',
        'type',
        'owner_id',
        'monthly',
        'description',
        'address',
        'name',
    ];

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function images () {
        return $this->hasMany(RoomImage::class, 'room_id');
    }
}
