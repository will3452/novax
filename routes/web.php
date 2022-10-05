<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {
    return redirect()->to('/admin');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


Route::post('login-with-sms', [LoginController::class, 'loginWithSMS'])->name('login.sms');
Route::get('login-with-sms', [LoginController::class, 'verifyOtp'])->name('verify.otp');
Route::post('verify-otp', [LoginController::class, 'checkOtp'])->name('check.otp');
