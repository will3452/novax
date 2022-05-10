<?php

use App\Models\User;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\RegisterController;

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

Route::get('/verify-email', function () {
    $user = User::find(request()->id);
    if ($user->hasVerifiedEmail()) {
        return 'you email has been validated!';
    }

    $user->markEmailAsVerified();
    return 'ok';
})->name('verification.verify');
