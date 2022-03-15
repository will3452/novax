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

    public function getRecordOf($userId): int
    {
        return $this->records()->whereUserId($userId)->latest()->first()->id;
    }
}
