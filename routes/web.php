<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Models\OrderProduct;

Route::redirect('/', '/admin/login');

Route::get('/login', fn () => 'you must be authenticated!')->name('login');

// Route::get('/register', [RegisterController::class, 'registrationPage']);
// Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/report', function () {
    $result = OrderProduct::with('seller')->whereBetween('created_at', [request()->from, request()->to])->whereCooperative(request()->cooperative)->whereProductCategory(request()->category)->get();
    return view('report', compact('result'));
})->name('report');

Route::get('test', fn()=>'test7@! asdsd'); //

Route::get('/verify-email', function (Request $request) {
    $request->user()->hasVerifiedEmail();
})->name('verification.verify');
