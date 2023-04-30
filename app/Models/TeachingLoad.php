<?php

namespace App\Models;

use App\Nova\Metrics\Students;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingLoad extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        // 'grade_system_id',
        'subject_id',
        'academic_year_id',
        'semester_id',
    ];

    protected $with = [
        'subject',
        'academicYear',
        'semester',
        'announcements',
        'students.profile',
        'studentRecords',
        'activities',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // public function gradeSystem() {
    //     return $this->belongsTo(GradeSystem::class);
    // }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_records', 'teaching_load_id', 'student_id');
    }

    public function studentRecords()
    {
        return $this->hasMany(StudentRecord::class, 'teaching_load_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
