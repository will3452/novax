<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Api\ErrorHelper;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function submit()
    {
        $score = request()->post('score') ?? 0;
        $topicId = request()->post('topic_id');

        if (is_null($topicId)) {
            return ErrorHelper::sendError(404);
        }

        $score = Score::create([
            'score'=>$score,
            'topic_id'=>$topicId,
            'user_id'=>auth()->id(),
        ]);

        return response([
            'message'=>"POSTED SUCCESS"
        ], 200);
    }

    public function show()
    {
        $topicId = request()->get('topic_id');

        if ($topicId == null) {
            return ErrorHelper::sendError(404);
        }

        $latestScore = Score::where([
            'user_id'=>auth()->id(),
            'topic_id'=>$topicId
        ])->latest()->first();

        return response([
            'score'=>$latestScore->score,
        ], 200);
    }
}
