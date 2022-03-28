<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'code',
        'strand',
        'level',
        'name',
        'time_limit',
        'is_manual_checking',
        'opened_at',
        'closed_at',
    ];

    protected $casts = [
        'opened_at' => 'date',
        'closed_at' => 'date',
    ];

    protected $with = [
        'questions',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id');
    }

    public function records()
    {
        return $this->hasMany(Record::class, 'exam_id');
    }

    public function hasRecordOf($userId): bool
    {
        return $this->records()->whereUserId($userId)->count();
    }

    public function getRecordIdOf($userId): int
    {
        return $this->records()->whereUserId($userId)->latest()->first()->id;
    }

    public function getRecordOf($userId)
    {
        return $this->records()->whereUserId($userId)->latest()->first();
    }

    public function canTakeOf($userId)
    {
        $record = $this->records()->whereUserId($userId)->latest()->first();

        if (! is_null($record)) {
            return false;
        }

        return true;
    }

    public function getTimeOfRecord($record)
    {
        return $this->time_limit - $record->created_at->diffInMinutes(now());
    }

    public function canTakeNow()
    {
        $dates = \Carbon\CarbonPeriod::create($this->opened_at, $this->closed_at);
        foreach ($dates as $date) {
            if ($date->format('m-d-y') === now()->format('m-d-y')) {
                return true;
            }
        }

        return false;
    }
}
