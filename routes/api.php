<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\GameRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


//game submit
Route::post('/save-record', function () {
    $data = [
        'user_id' => request()->user,
        'missed' => request()->wrongs,
        'turns' => request()->turns,
        'time' => request()->time,
        'type' => request()->type,
    ];

    return GameRecord::create($data);
});
