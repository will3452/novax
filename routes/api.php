<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiBmsController;
use App\Http\Controllers\ApiStatController;
use App\Http\Controllers\ApiDifficultyController;
use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiRecipeController;

//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function () {
        return 'authentication test';
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::post('/mark-as-done', [ApiDifficultyController::class, 'markAsDone']);

    Route::get('/is-done', [ApiDifficultyController::class, 'isDone']);

    Route::get('/stats', [ApiStatController::class, 'index']);

    Route::post('/bms', [ApiBmsController::class, 'create']);
    Route::get('/bms', [ApiBmsController::class, 'index']);
});



//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);




Route::get('/difficulties', [ApiDifficultyController::class, 'index']);
Route::get('/recipes', [ApiRecipeController::class, 'index']);
Route::get('/recipes/{recipe}', [ApiRecipeController::class, 'show']);
