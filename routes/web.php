<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ChildrenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HouseHoldProfileController;
use App\Http\Controllers\PregnantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::prefix('/users')->name('users.')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::get('/create', [UsersController::class, 'create'])->name('create');
    Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('edit');
    Route::get('/{user}', [UsersController::class, 'show'])->name('show');
    Route::put('/{user}', [UsersController::class, 'update'])->name('update');
    Route::post('/', [UsersController::class, 'store']);
});

Route::prefix('/announcements')->name('announcements.')->group(function () {
    Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    Route::get('/create', [AnnouncementController::class, 'create'])->name('create');
    Route::post('/', [AnnouncementController::class, 'store']);
});

Route::prefix('/profiles')->name('profiles.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/create', [ProfileController::class, 'create'])->name('create');
    Route::get('/{profile}/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::get('/{profile}', [ProfileController::class, 'show'])->name('show');
    Route::put('/{profile}', [ProfileController::class, 'update'])->name('update');
    Route::post('/', [ProfileController::class, 'store']);
});

Route::prefix('/generals')->name('generals.')->group(function () {
    Route::get('/', [GeneralController::class, 'index'])->name('index');
    Route::get('/create', [GeneralController::class, 'create'])->name('create');
    Route::get('/{general}/edit', [GeneralController::class, 'edit'])->name('edit');
    Route::get('/{general}', [GeneralController::class, 'show'])->name('show');
    Route::put('/{general}', [GeneralController::class, 'update'])->name('update');
    Route::post('/', [GeneralController::class, 'store']);
});

Route::prefix('/pregnants')->name('pregnants.')->group(function () {
    Route::get('/', [PregnantController::class, 'index'])->name('index');
    Route::get('/create', [PregnantController::class, 'create'])->name('create');
    Route::get('/{pregnant}/edit', [PregnantController::class, 'edit'])->name('edit');
    Route::get('/{pregnant}', [PregnantController::class, 'show'])->name('show');
    Route::put('/{pregnant}', [PregnantController::class, 'update'])->name('update');
    Route::post('/', [PregnantController::class, 'store']);
});

Route::prefix('/children')->name('children.')->group(function () {
    Route::get('/', [ChildrenController::class, 'index'])->name('index');
    Route::get('/create', [ChildrenController::class, 'create'])->name('create');
    Route::get('/{children}/edit', [ChildrenController::class, 'edit'])->name('edit');
    Route::get('/{children}', [ChildrenController::class, 'show'])->name('show');
    Route::put('/{children}', [ChildrenController::class, 'update'])->name('update');
    Route::post('/', [ChildrenController::class, 'store']);
});

Route::prefix('/house-hold-profile')->name('hh.')->group(function () {
    Route::get('/', [HouseHoldProfileController::class, 'index'])->name('index');
    Route::get('/create', [HouseHoldProfileController::class, 'create'])->name('create');
    Route::get('/{hh}/edit', [HouseHoldProfileController::class, 'edit'])->name('edit');
    Route::get('/{hh}', [HouseHoldProfileController::class, 'show'])->name('show');
    Route::put('/{hh}', [HouseHoldProfileController::class, 'update'])->name('update');
    Route::post('/', [HouseHoldProfileController::class, 'store']);
    Route::post('/toggle-profile/{hh}', [HouseHoldProfileController::class, 'toggleProfile'])->name('toggle');
});


Route::get('/search', [SearchController::class, 'index'])->name('search');
