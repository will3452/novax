<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    use HasFactory;

    protected $with = [
        'student.profile',
    ];

    protected $fillable = [
        'student_id',
        'subject_id',
        'teacher_id',
        'academic_year_id',
        'semester_id',
        'teaching_load_id',
        'final_grade',
        'total_grade',
        'prelim_grade',
        'midterm_grade',
        'pre_final_grade',
        'remarks',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
