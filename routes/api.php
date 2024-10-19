<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Attendance;
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
    }

    return $exists->update(['out' => now(), 'place_out' => $request->place]);
});
