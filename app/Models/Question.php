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

    public function getStorageQuestionAttribute()
    {
        $arr = explode("/", $this->question_image);
        $end = end($arr);

        return "/storage/" . $end;
    }

    public function getAllChoice($str)
    {
        if (is_null($str)) {
            $str = $this->choices;
        }

        return self::parseArray($str);
    }

    public static function parseArray($str)
    {
        $arr = explode('{"value":"', $str);
        $str = implode("", $arr);
        $arr = explode("\"}", $str);
        $str = implode("", $arr);
        $arr = explode('[', $str);
        $str = implode("", $arr);
        $arr = explode(']', $str);
        $str = implode("", $arr);

        return explode(',', $str);
    }

    public function studentAnswers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    const TYPE_MULTIPLE_CHOICE = 'Multiple Choice';
    const TYPE_IDENTIFICATION = 'Identification';
    const TYPE_TRUE_OR_FALSE = 'True or False';
    const TYPE_ESSAY = 'Essay';
    const TYPE_MULTIPLE_ANSWER = 'Multiple Answer';
}
