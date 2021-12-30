<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_number',
        'first_name',
        'last_name',
        'middle_name',
        'address',
        'gender',
        'birthdate',
        'course_id',
        'branch_id'
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name . ', '. $this->middle_name;
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function counsellingStudents()
    {
        return $this->hasMany(CounsellingStudent::class);
    }
}
