<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'question_id',
        'status',
        'value',
    ];

    protected $with = [
        'question',
    ];

    const STATUS_WRONG = 'Wrong';
    const STATUS_CORRECT = 'Correct';
    const STATUS_NOT_CHECKED = 'Not yet checked';

    public function record()
    {
        return $this->belongsTo(Record::class, 'record_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
