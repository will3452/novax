<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model // connection between student and course
{
    use HasFactory;

    protected $fillable = [
        'user_id', // student
        'course_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    //methods
    public static function addStudent($userId, $courseId)
    {
        static::create([
            'user_id' => $userId,
            'course_id' => $courseId,
        ]);
    }
}
