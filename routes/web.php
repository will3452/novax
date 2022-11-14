<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::name('products.')->middleware(['auth'])->prefix('/products')->group(function () {
    //discount
    Route::post('/discount', [ProductController::class, 'applyDiscount'])->name('discount');

    // cart
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
    Route::post('/add-cart/{product}', [ProductController::class, 'addToCart'])->name('to-cart');
    Route::delete('/remove-to-cart/{product}', [ProductController::class, 'removeToCart'])->name('remove-to-cart');

    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

Route::name('orders.')->middleware(['auth'])->prefix('/orders')->group(function () {
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/', [OrderController::class, 'index'])->name('index');
});
