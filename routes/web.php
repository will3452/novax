<?php

use App\Http\Controllers\CartController;
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
Route::post('/remove-to-cart/{id}', [CartController::class, 'removeToCart']);
Route::get('/carts', [CartController::class, 'index']);


Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
