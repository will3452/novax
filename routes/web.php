<?php

use App\Http\Controllers\NewsfeedController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TeachingLoadController;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/admin/login');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('newsfeed')->name('nf.')->group(function () {
    Route::get('/', [NewsfeedController::class, 'index'])->name('index');
    Route::get('/create', [NewsfeedController::class, 'create'])->name('create');
    Route::post('/', [NewsfeedController::class, 'store'])->name('post');
});

Route::prefix('teaching-load')->name('tl.')->group(function () {
    Route::get('/', [TeachingLoadController::class, 'index'])->name('index');
    Route::get('/{load}', [TeachingLoadController::class, 'show'])->name('show');
});

Route::prefix('ajax')->group(function () {
    // get comments
    Route::get('/comments', fn(Request $request) => Comment::with('user')->where(['commentable_type' => $request->type, 'commentable_id' => $request->id])->latest()->limit(5)->get());
    Route::post('/comments', function (Request $request) {
        return auth()->user()->comments()->create($request->all());
    });
});

Route::get('/logout', function (Request $request) {
    auth()->user()->update(['last_login_at' => now()]);
    return redirect()->to(route('nova.logout'));
});
