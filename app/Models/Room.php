<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year_level',
        'teacher_id',
        'code',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function studentRooms()
    {
        return $this->hasMany(StudentRoom::class, 'room_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
