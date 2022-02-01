<?php

namespace App\Models;

use App\Observers\CounsellingObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counselling extends Model
{
    use HasFactory;

    const STATUS_DRAFTED = 'Drafted';
    const STATUS_SAVED = 'Saved';
    const STATUS_SOLVED = 'Solved';
    const STATUS_RESCHEDULED = 'Re-scheduled';
    const STATS_TO_FOLLOW = 'To follow Up';
    const TYPE_GROUP = 'group';
    const TYPE_INDIVIDUAL = 'individual';

    protected $fillable = [
        'reference_number',
        'case',
        'goal',
        'plan',
        'recommendation',
        'status',
        'branch_id',
    ];

    // public function students()
    // {
    //     return $this->belongsToMany(Student::class, 'counselling_student', 'counselling_id', 'student_id');
    // }

    public function counsellingStudents()
    {
        return $this->hasMany(CounsellingStudent::class, 'counselling_id');
    }

    public function counsellingStudent()
    {
        return $this->hasOne(CounsellingStudent::class, 'counselling_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public static function boot()
    {
        parent::boot();
        Counselling::observe(CounsellingObserver::class);
    }
}
