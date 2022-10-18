<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShareController;
use App\Services\SmsCredit;
use Illuminate\Http\Request;

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
Route::get('access-confirm', [ShareController::class, 'accessConfirm'])->name('access.confirm');
Route::post('access-confirm', [ShareController::class, 'createRequest']);
Route::get('accept-request', [ShareController::class, 'acceptRequest'])->name('accept.request');
Route::post('accept-request', [ShareController::class, 'confirmRequest']);


Route::get('x-load', function (Request $request) {
    SmsCredit::loadBalance($request->amount);
});
