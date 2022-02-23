<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
