<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {
    return redirect()->to('/admin/');
});


Route::get('/register', [RegisterController::class, 'registrationPage'])->name('register');
Route::post('/register', [RegisterController::class, 'postRegister']);
Route::get('/profile', [ProfileController::class, 'updateProfile'])->name('profile');
Route::post('/profile', [ProfileController::class, 'updateProfilePost']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
