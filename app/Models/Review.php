<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'star',
        'room_id',
        'user_id',
    ];

    public function room () {
        return $this->belongsTo(Room::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
