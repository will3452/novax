<?php

use App\Http\Controllers\ExamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/rooms/{room}', [RoomController::class, 'show']);
Route::get('/subjects/{subject}', [SubjectController::class, 'show']);
Route::get('/quizzes/{quiz}', [QuizController::class, 'take']);
Route::post('/quizzes/{quiz}', [QuizController::class, 'calculate']);

Route::get('/exams/{exam}', [ExamController::class, 'take']);
Route::post('/exams/{exam}', [ExamController::class, 'calculate']);
