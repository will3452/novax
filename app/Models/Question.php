<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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

    public function getRandomChoicesAttribute()
    {
        $arr = explode(self::SEPARATOR, $this->choices);
        array_push($arr, $this->correct_answer);

        return Arr::shuffle($arr);
    }
}
