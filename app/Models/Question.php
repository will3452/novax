<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    const SEPARATOR = "!!_***_!!";

    protected $fillable = [
        'exam_id',
        'question',
        'question_image',
        'type',
        'answer',
        'choices',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function getAllChoiceAttribute()
    {
        $arr = explode('{"value":"', $this->choices);
        $str = implode("", $arr);
        $arr = explode("\"}", $str);
        $str = implode("", $arr);
        $arr = explode('[', $str);
        $str = implode("", $arr);
        $arr = explode(']', $str);
        $str = implode("", $arr);
        return explode(',', $str);
    }

    const TYPE_MULTIPLE_CHOICE = 'Multiple Choice';
    const TYPE_IDENTIFICATION = 'Identification';
    const TYPE_TRUE_OR_FALSE = 'True or False';
}
