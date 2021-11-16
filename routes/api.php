<?php

use App\Models\User;
use App\Models\Level;
use App\Models\Score;
use App\Models\Topic;
use App\Api\ErrorHelper;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\ApiAuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function () {
        return 'authentication test';
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::post('/score', function () {
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
    });

    Route::get('/score', function () {
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
    });

    Route::get('/leaderboard', function () {
        $type = request()->get('type') ?? 'topic';
        $topicId = request()->get('topic_id');
        $limit= request()->get('limit') ?? 10;
        $users = null;
        if ($type != 'topic') {
            $users = User::withSum('scores', 'score')->orderBy('scores_sum_score', 'DESC')->take($limit)->get();
        } else {
            if ($topicId == null) {
                return ErrorHelper::sendError(404);
            }
            $users = Topic::find($topicId)->scores()->orderBy('score', 'ASC')->take($limit)->with('user')->get();
        }

        return response([
            'leaderboard'=>$users,
        ], 200) ;
    });
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

//get categories
Route::get('/categories', function () {
    $categories = Category::withCount('topics')->get();
    return response([
        'categories'=>$categories,
    ], 200);
});

//get levels
Route::get('/levels', function () {
    $levels = Level::get();
    return response([
        'levels'=>$levels->pluck('name'),
    ], 200);
});

Route::get('/topics', function () {
    $level = request()->get('level');
    $category = request()->get('category_id');
    $topics = null;

    if ($level == null && $category == null) {
        return ErrorHelper::sendError(400);
    }

    if (is_null($category) && !is_null($level)) {
        $topics = Topic::where('level', $level)->get();
    } elseif (is_null($level) && !is_null($category)) {
        $topics = Topic::where([
            'category_id'=>$category,
        ])->get();
    } else {
        $topics = Topic::where([
            'level' => $level,
            'category_id'=>$category,
        ])->get();
    }

    return response([
        'topics'=>$topics
    ], 200);
});

Route::get('/questions', function () {
    $topicId = request()->get('topic_id');

    if (is_null($topicId)) {
        return ErrorHelper::sendError(404);
    }

    $quetions = Question::where('topic_id', $topicId)->with('answers')->inRandomOrder()->get();
    return response([
        'questions'=>$quetions
    ], 200);
});
