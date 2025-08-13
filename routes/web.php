<?php

use App\Http\Controllers\PaymentController;
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

Route::get('/create-transaction', [PaymentController::class, 'createTransaction'])->name('createTransaction');
Route::get('/process-transaction', [PaymentController::class, 'processTransaction'])->name('processTransaction');
Route::get('/success-transaction', [PaymentController::class, 'successTransaction'])->name('successTransaction');
Route::get('/cancel-transaction', [PaymentController::class, 'cancelTransaction'])->name('cancelTransaction');
