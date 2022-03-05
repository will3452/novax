<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TakeController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::prefix('teacher')->name('teacher.')->middleware(['auth'])->group(function () {
    //rooms
    Route::get('/room', [RoomController::class, 'teacherRoom'])->name('room');
});

Route::prefix('student')->name('student.')->middleware(['auth'])->group(function () {
    //rooms
    Route::get('/room', [RoomController::class, 'studentRoom'])->name('room');
});

//subjects
Route::get('/subjects/{subject}', [SubjectController::class, 'show']);

//records
Route::get('/save-records/{type}/{id}/{userId}', [RecordController::class, 'saveRecord']);
Route::get('/view-records/{type}/{id}', [RecordController::class, 'show']);
Route::post('/update-score/{record}', [RecordController::class, 'updateScore']);

//taking activities controller
Route::get('/take/{category}/{id}', [TakeController::class, 'take']);
Route::post('/submit-project/{activity}', [TakeController::class, 'submitProject']);
Route::post('/submit-answers/{activity}', [TakeController::class, 'submitAnswer']);

Route::view('/home', 'home')->middleware(['auth']);

Route::view('/forgot-password', 'forgotpassword');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

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
