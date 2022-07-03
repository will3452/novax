<?php

use App\Http\Controllers\AllergyController;
use App\Http\Controllers\BmiController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\ProgressController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;


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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::get('/bmi', [BmiController::class, 'index'])->name('bmi');
Route::post('/bmi', [BmiController::class, 'save']);

Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises');
Route::get('/exercises/{e}', [ExerciseController::class, 'show'])->name('exercises.show');

Route::get('/meals', [MealController::class, 'index'])->name('meal');

Route::post('/progress', [ProgressController::class, 'submitProgress'])->name('progress');
Route::get('/progress', [ProgressController::class, 'index']);
Route::post('/allergy', [AllergyController::class, 'save'])->name('allergy');
