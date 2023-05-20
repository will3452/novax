<?php

use App\Http\Controllers\RegisterController;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

Route::post('/fb', function (Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'profession' => 'required',
        'message' => 'required',
    ]);

    Feedback::create($data);
    return 'Your feedback has been submitted. <a href="/">Go back to home?</a>';
});

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
