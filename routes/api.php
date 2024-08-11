<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function () {
        return 'authentication test';
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::get('/me', function (Request $request) {
        $user = User::find(auth()->id());
        $user->load(['cartItems', 'bookings']);
        return $user;  
    });

    Route::resource('/bookings', BookingController::class); 
    Route::resource('/cart-items', CartController::class); 
    Route::resource('/orders', OrderController::class); 
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::resource('/services', ServiceController::class); 
Route::resource('/products', ProductController::class); 
