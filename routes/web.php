<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TakeController;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

Route::get('/', function () {
    return view('welcome');
});

Route::get('result', function (Request $request) {
    $record = Record::find($request->record_id);
    if (auth()->user()->id !== $record->user_id) {
        return abort(403);
    }
    $score = $record->score;
    return view('take_done', compact('record', 'score'));
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
Route::get('/exams/reports/{exam}', [ExamController::class, 'showReport'])->name('exam.report');
Route::get('/exams/result/{exam}', [ExamController::class, 'showRecords'])->name('exam.result');
Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exam.show');
Route::delete('/exams/{exam}', [ExamController::class, 'destroy']);
Route::post('/exams', [ExamController::class, 'store']);
Route::get('/update-grade/{record}', function () {

});

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
