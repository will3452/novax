<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiCartController;
use App\Http\Controllers\ApiOrderController;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\ApiSalesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\BackupTool\Http\Controllers\ApiController;

//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
    Route::post('/products', [ApiProductController::class, 'store']);
    Route::get('/my-products', [ApiProductController::class, 'myProducts']);

    //cart items
    Route::get('/get-cart-items', [ApiCartController::class, 'getCartItems']);
    Route::post('/add-to-cart', [ApiCartController::class, 'addToCart']);
    Route::post('/remove-to-cart', [ApiCartController::class, 'removeToCart']);
    Route::post('clear-cart', [ApiCartController::class, 'clearCart']);
    Route::post('checkout', [ApiCartController::class, 'processCartToOrder']);

    //orders | consumer
    Route::get('/orders', [ApiOrderController::class, 'getOrders']);

    //sales | seller
    Route::get('/sales', [ApiSalesController::class, 'getSales']);
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
Route::get('/store-master', [ApiProductController::class, 'master']);
