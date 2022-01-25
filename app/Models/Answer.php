<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'answer',
        'type',
        'question_id',
    ];

    const TYPE_CORRECT = 'Correct';
    const TYPE_WRONG = 'Wrong';

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
