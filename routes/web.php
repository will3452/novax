<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Crypt;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register', [RegisterController::class, 'registrationPage']);
// Route::post('/register', [RegisterController::class, 'postRegister']);

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware(['guest']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/exams', [ExamController::class, 'index'])->middleware('auth');
Route::get('/exams/{exam}', [ExamController::class, 'show']);
Route::delete('/exams/{exam}', [ExamController::class, 'destroy']);
Route::post('/exams', [ExamController::class, 'store']);

Route::post('/questions', [QuestionController::class, 'store']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
