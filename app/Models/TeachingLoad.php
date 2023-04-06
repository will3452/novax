<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingLoad extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'grade_system_id',
        'subject_id',
        'academic_year_id',
        'semester_id'
    ];

    public function teacher () {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function gradeSystem() {
        return $this->belongsTo(GradeSystem::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function academicYear() {
        return $this->belongsTo(AcademicYear::class);
    }

    public function semester() {
        return $this->belongsTo(Semester::class);
    }
}
