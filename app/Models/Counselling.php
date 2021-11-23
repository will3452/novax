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

    protected $fillable = [
        'reference_number',
        'case',
        'goal',
        'plan',
        'recommendation',
        'status'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'counselling_student', 'counselling_id', 'student_id');
    }

    public static function boot()
    {
        parent::boot();
        Counselling::observe(CounsellingObserver::class);
    }
}
