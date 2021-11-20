<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', LandingController::class);

Route::get('/search', SearchController::class);



Route::get('/location-not-found', function () {
    return "location not found";
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'show']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/shops/{shop}', [ShopController::class, 'show']);
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });
    Route::post('/booking/{shop}', [BookingController::class, 'bookToday']);

    Route::get('/bookings', [BookingController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'showProfile']);
    Route::post('/profile', [ProfileController::class, 'updateProfile']);
});


Route::view('/success-register', 'success_register');
