<?php

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
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
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);



Route::get('/workout-reminder', function (Request $request) {
    try {

        $day = now()->dayOfWeekIso;

        $schedules = Schedule::where('day', $day)->get();

        $users = User::where('workout_reminder', 1)->whereIn('program_id', $schedules->pluck('program_id')->toArray())->get();


        foreach ($users as $user) {
            $email = $user->email;
            Mail::raw( "Good day, I want you to know that you have a schedule today based on your chosen program from San Fabian Gym Center. " , function($message) use ($email) {
                $message->to($email)->subject('Workout reminder');
            });
        }

        return 1;

    } catch (Exception $e) {
        return 0;
    }
});
