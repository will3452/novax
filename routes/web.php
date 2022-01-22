<?php

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CovidController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::redirect('/', Nova::path());

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


Route::get('covid', [CovidController::class, 'index'])->name('covid.index');
Route::get('covid/{covidInfo}', [CovidController::class, 'show']);

Route::get('/expert', [ExpertController::class, 'index']);
Route::post(Nova::path() . "/login", [LoginController::class, 'login'])->name('nova.login');
