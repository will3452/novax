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
        return [
            'leaderboard' => User::withAvg('scores', 'score')->withCount('scores')->orderBy('scores_avg_score', 'DESC')->get(),
        ];
    }
}
