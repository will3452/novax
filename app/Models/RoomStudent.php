<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'room_id',
    ];

    public function student () {
        return $this->belongsTo(User::class);
    }

    public function room () {
        return $this->belongsTo(Room::class);
    }
}
