<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    const TYPE_WRONG = 'wrong';
    const TYPE_CORRECT = 'correct';
    use HasFactory;

    protected $fillable = [
        'question_id',
        'value',
        'type',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
