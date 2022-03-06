<?php

namespace App\Models;

use App\Models\Traits\HasFeedback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory,
        HasFeedback;

    protected $fillable = [
        'name',
        'year_level',
        'teacher_id',
        'code',
    ];

    protected $with = [
        'subjects',
        'studentRooms',
        'teacher',
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
