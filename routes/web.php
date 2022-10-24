<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PuzzleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\StoryModeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/story-mode', [StoryModeController::class, 'index']);
Route::get('/story-mode/{story}', [StoryModeController::class, 'show']);
Route::get('quiz-now/{story}', [StoryModeController::class, 'quiz']);
Route::get('/puzzle', [PuzzleController::class, 'index']);
Route::get('/scene/{scene}', [SceneController::class, 'show']);
