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
        'description',
    ];

    protected $casts = [
        'opened_at' => 'date',
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

    public static function getExamCurrentYear()
    {
        $result = [];
        $yearExam = Exam::whereYear('created_at', '=', now()->format('Y'))->get()->groupBy(function ($e) {
            return $e->created_at->format('Y-m-d');
        } );
        foreach ($yearExam as $key => $value) {
            $result[$key] = count($value);
        }

        return $result;
    }

    public function averageScore()
    {
        $sum = 0;
        foreach ($this->records as $r) {
            $arr = explode('/', $r->score);
            $sum += is_numeric($arr[0]) ? $arr[0] : 0;
        }
        if (! $this->records()->count()) {
            return 0;
        }
        return $sum / $this->records()->count();
    }

    public function highestScore()
    {
        if ($this->records()->count() <= 1) {
            return '---';
        }
        $init = explode('/', $this->records()->first()->score);
        $highest = $init[0];

        foreach ($this->records as $r) {
            $s = explode('/', $r->score);
            if ($highest < $s[0]) {
                $highest = $s[0];
            }
        }
        return $highest;
    }

    public function lowestScore()
    {
        if ($this->records()->count() <= 1) {
            return '---';
        }
        $init = explode('/', $this->records()->first()->score);
        $lowest = $init[0];
        foreach ($this->records as $r) {
            $s = explode('/', $this->records()->first()->score);
            if ($lowest > $s[0]) {
                $lowest = $s[0];
            }
        }
        return $lowest;
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
        return $this->opened_at->format('m-d-y') === now()->format('m-d-y');
    }
}
