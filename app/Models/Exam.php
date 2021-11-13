<?php

namespace App\Models;

use App\Models\Traits\HasQuestions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory, HasQuestions;
    protected $guarded = [];
    public function module()
    {
        return $this->belongsTo(Module::class);
    }


    public function wasTaken($userId)
    {
        $result = UserExam::where([
            'exam_id'=>$this->id,
            'user_id'=>$userId
        ])->count();

        return $result !== 0;
    }

    public function getScore($userId)
    {
        $result = UserExam::where([
            'exam_id'=>$this->id,
            'user_id'=>$userId
        ])->first();

        return $result->score;
    }
}
