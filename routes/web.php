<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TakeController;
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
Route::put('/exams/{exam}', [ExamController::class, 'update']);
Route::get('/exams/{exam}', [ExamController::class, 'show']);
Route::delete('/exams/{exam}', [ExamController::class, 'destroy']);
Route::post('/exams', [ExamController::class, 'store']);

Route::post('/questions', [QuestionController::class, 'store']);
Route::delete('/questions/{question}', [QuestionController::class, 'destroy']);

Route::post('take-now/{exam}', [TakeController::class, 'takeNow']);
Route::get('take/{record}', [TakeController::class, 'take']);
Route::post('submit/{record}', [TakeController::class, 'submit']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
