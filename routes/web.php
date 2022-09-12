<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Models\Product;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $products = [];
    $search = $request->search;
    if ($request->has('category')) {
        if ($request->category == 'Latest products') {
            $products = Product::where('name', 'LIKE', '%'.$search.'%')->latest()->take(10)->paginate(10)->withQueryString();
        } else {
            $products = Product::where('name', 'LIKE', '%'.$search.'%')->whereCategory($request->category)->paginate(10)->withQueryString();
        }
    } else {
        $products = Product::where('name', 'LIKE', '%'.$search.'%')->latest()->take(10)->paginate(10)->withQueryString();
    }
    return view('welcome', compact('products'));
});

Route::redirect('/login', '/app/login')->name('login');

// cart
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart']);
Route::put('/update-cart/{item}', [CartController::class, 'updateCart']);
Route::post('/remove-to-cart/{id}', [CartController::class, 'removeToCart']);
Route::get('/carts', [CartController::class, 'index']);
Route::post('/checkout', [CartController::class, 'checkout']);


Route::get('/orders', [OrderController::class, 'index']);

Route::get('/get-discount', [PromoController::class, 'getDiscount']);


Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);
Route::get('/logout', function () {
    auth()->logout();
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
