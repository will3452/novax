<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\TaskResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::get('/time-status', function (Request $request) {
    $exists = Attendance::whereUserId($request->userId)->whereDate('in', now()->today())->whereNull('out')->exists();
    return $exists;
});

Route::post('/time', function (Request $request) {
    $exists = Attendance::whereUserId($request->userId)->whereDate('in', now()->today())->whereNull('out')->first();
    if (! $exists) {
        return Attendance::create([
            'user_id' => $request->userId,
            'in' => now(),
            'place_in' => $request->place
        ]);
    } else {
        if ($exists->in->diffInHours(now()) >= 0) {
            return $exists->update(['out' => now(), 'place_out' => $request->place]);
        } else {
            return 0;
        }
    }

});

Route::post('/upload-image', function (Request $request) {
    $arr = explode("/", $request->image->store('public'));
    $path = end($arr);
    return $path;
});

Route::post('/upload-task-result', function (Request $request) {
    $ass = Assignment::whereUserId($request->user_id)->whereTaskId($request->task_id)->first();
    if (! $ass->proof_of_initiation) {
        $ass->update(['proof_of_initiation' => $request->image]);
    } else {
        $ass->update(['proof_of_done' => $request->image, 'status' => 'DONE']);
    }
    return TaskResult::create([
        'user_id' => $request->user_id,
        'task_id' => $request->task_id,
        'result' => $request->result,
        'image' => $request->image
    ]);
});
