<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'attempt_id',
        'type', // true
        'answer_id',
        'question_id',
    ];

    protected $with = [
        'answer',
        'question',
    ];

    const TYPE_WRONG = 'Wrong';
    const TYPE_CORRECT = 'Correct';

    public function attempt()
    {
        return $this->belongsTo(Attempt::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
