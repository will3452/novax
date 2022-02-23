<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    const SEPARATOR = '!==!';

    protected $fillable = [
        'type', //identification, multiple choice
        'correct_answer',
        'actual_question',
        'activity_id',
        'choices',
    ];

    const TYPE_IDENTIFICATION = 'Identification';
    const TYPE_MULTIPLECHOICE = 'Multiple Choice';

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
