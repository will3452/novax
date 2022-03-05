<?php

namespace App\Models;

use App\Models\Traits\HasRecords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory,
        HasRecords;
    protected $fillable = [
        'type',
        'category',//quiz, exam, project
        'name',
        'module_id',
        'deadline',
        'time_limit',
        'instruction',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    const CATEGORY_QUIZ = 'Quiz';
    const CATEGORY_EXAM = 'Examination';
    const CATEGORY_PROJECT = 'Project';

    const TYPE_ASYNCHRONOUS = 'Asynchronous';
    const TYPE_SYNCHRONOUS = 'Synchronous';

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
