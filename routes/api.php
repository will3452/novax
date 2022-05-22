<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Client;
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

Route::get('/request-key/{key}', function (Request $request, $key) {
    $client = Client::where('key', $key)->first();

    if ($client && $client->active){
        return nova_get_setting('api_key');
    }

    return response('wrong creds', 404);
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);
