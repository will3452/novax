<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiBmsController;
use App\Http\Controllers\ApiDifficultyController;
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


Route::post('/bms', [ApiBmsController::class, 'create']);
Route::get('/bms', [ApiBmsController::class, 'index']);

Route::get('/difficulties', [ApiDifficultyController::class, 'index']);
