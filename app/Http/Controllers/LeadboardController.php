<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Api\ErrorHelper;
use Illuminate\Http\Request;

class LeadboardController extends Controller
{
    public function getLeaderboard()
    {
        return 1;
        // $type = request()->get('type') ?? 'topic';
        // $topicId = request()->get('topic_id');
        // $limit= request()->get('limit') ?? 10;
        // $users = null;
        // if ($type != 'topic') {
        //     $users = User::withSum('scores', 'score')->orderBy('scores_sum_score', 'DESC')->take($limit)->get();
        // } else {
        //     if ($topicId == null) {
        //         return ErrorHelper::sendError(404);
        //     }
        //     $users = Topic::find($topicId)->scores()->orderBy('score', 'DESC')->take($limit)->with('user')->get();
        // }

        // return response([
        //     'leaderboard'=>$users,
        // ], 200) ;
    }
}
