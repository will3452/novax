<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {
    return redirect()->to(route('login'));
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('records')->name('records.')->group(function () {
    Route::get('/', [RecordController::class, 'index'])->name('index');
    Route::post('/', [RecordController::class, 'store']);
});

Route::prefix('profiles')->name('profiles.')->group(function () {
    Route::get('/{user}', [ProfileController::class, 'show'])->name('show');
    Route::put('/preference/{user}', [ProfileController::class, 'savePreference'])->name('update.preferences');
    Route::put('/accounts/{user}', [ProfileController::class, 'saveAccount'])->name('update.account');
});

Route::prefix('foods')->name('foods.')->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('index');
});

Route::prefix('exercises')->name('exercises.')->group(function () {
    Route::get('/', [ExerciseController::class, 'index'])->name('index');
});

Route::prefix('activities')->name('activities.')->group(function () {
    Route::post('/add-activity', [ActivityController::class, 'addActivity'])->name('add');
});
