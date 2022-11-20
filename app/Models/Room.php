<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type_id',
        'roomno',
        'description',
        'image',
        'monthly',
    ];

    public function user () {
        return $this->hasOne(User::class);
    }

    public function roomType() {
        return $this->belongsTo(RoomType::class);
    }
}
