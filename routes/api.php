<?php

use App\Http\Controllers\ApiAuthenticationController;
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

    Route::post('/resource', function (Request $request) {
        $model = $request->model;
        $method = $request->method;
        $payload = $request->payload;

        $model = "\\App\\Models\\$model";
        if ($payload) {

            return ($model)::$method($payload);
        }
        return ($model)::$method();
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::get('/test', function (Request $request) {
    $model = $request->model;
    $method = $request->method;
    $payload = $request->payload;

    $model = "\\App\\Models\\$model";
    if ($payload) {

        return ($model)::$method($payload);
    }
    return ($model)::$method();
});
