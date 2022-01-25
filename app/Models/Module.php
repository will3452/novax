<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'material',
        'course_id',
        'user_id', // instructor who upload
        'status' // ENABLED | DISABLED
    ];

    const STATUS_ENABLE = 'Enabled';
    const STATUS_DISABLED = 'Disabled';

    public function toggleStatus()
    {
        $status = $this->status === self::STATUS_DISABLED ? self::STATUS_ENABLE : self::STATUS_DISABLED;
        return $this->update([
            'status' => $status,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
