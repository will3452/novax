<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/register');
})->middleware(['auth']);


Route::middleware(['auth'])->group(function () {
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::post('/', [ReportController::class, 'store'])->name('store'); 
    }); 


    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('index'); 
        Route::get('/{post}', [NewsController::class, 'show'])->name('show'); 
    });


    Route::prefix('organization')->name('organizations.')->group(function () {
        Route::view('/', 'organization');
    }); 
});
