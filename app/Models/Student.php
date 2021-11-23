<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [
        'user_id',
        'student_number',
        'first_name',
        'last_name',
        'middle_name',
        'address',
        'gender',
        'birthdate',
        'course_id',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name . ', '. $this->middle_name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function counsellings()
    {
        return $this->belongsToMany(Counselling::class, 'counselling_student', 'student_id', 'counselling_id');
    }
}
