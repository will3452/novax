<?php

use App\Http\Controllers\AppsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Access\Gate;

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('home'));
});

//dashboard
Route::get('/home', [DashboardController::class, 'index'])->name('home');

//games
Route::get('games/sudoku', [GameController::class, 'sudoku']);
Route::get('games/flip-card', [GameController::class, 'flipCard']);

//gallery
Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('gallery/create', [GalleryController::class, 'create']);
Route::post('gallery', [GalleryController::class, 'store']);
Route::get('gallery/remove/{image}', [GalleryController::class, 'delete']);

//apps controller
Route::get('/applications', [AppsController::class, 'index']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
