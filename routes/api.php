<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
    Route::post('/products', [ApiProductController::class, 'store']);
    Route::get('/my-products', [ApiProductController::class, 'myProducts']);
});

Route::get('/public-test', function () {
    return 'public test';
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);
Route::post('/request-verification-code', [ApiAuthenticationController::class, 'requestVerificationCode']);
Route::post('/submit-verification-code', [ApiAuthenticationController::class, 'submitCode']);

Route::get('/products', [ApiProductController::class, 'products']);
