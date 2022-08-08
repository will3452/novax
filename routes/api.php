<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\FileImageController;
use App\Models\Discount;
use App\Models\Notice;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function () {
        return 'authentication test';
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::get('/latest-notices', function (Request $req) {
    $notices = Notice::latest()->take(5)->get();
    return $notices;
});

// trip
Route::get('/trips', function (Request $req) {
    $trip = Trip::get(); // get all trip
    return $trip;
});

//discounts
Route::get('/discounts', fn (Request $request) => Discount::get());

Route::post('/file-image-upload', [FileImageController::class, 'upload']);
