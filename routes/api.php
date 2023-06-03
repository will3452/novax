<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Favorite;
use App\Models\Pet;
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
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::prefix('pets')->group(function () {
        Route::get('/', function (Request $request) {
            return Pet::whereDoesntHave('adopt')->get();
        });

        Route::post('/add-to-fav', function (Request $request) {
            return Favorite::create(['pet_id' => $request->pet_id, 'user_id' => auth()->id()]);
        });
    });
});

Route::get('/public-test', function () {
    return 'public test';
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);
