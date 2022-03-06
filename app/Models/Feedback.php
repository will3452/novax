<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'reply_to_feedback_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function replies()
    {
        return $this->hasMany(Feedback::class, 'reply_to_feedback_id');
    }

}
