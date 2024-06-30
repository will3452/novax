<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreCategoryController;
use App\Http\Controllers\StoreController;
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
    Route::get('/session', function (Request $request) {
        return $request->user(); 
    }); 
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::resource('products', ProductController::class); 
Route::resource('stores', StoreController::class); 
Route::resource('store-categories', StoreCategoryController::class); 

Route::post('/generate-token', function (Request $request) {
    $header = base64_encode("pk_test_lbqjzyCPiyBmvaGtRrMGI6".":"); 
    $cardObj = [
        'card' => [
            'name' => $request->name, 
            'number' => $request->number, 
            'exp_month' => $request->exp_month, 
            'exp_year' => $request->exp_year, 
            'cvc' => $request->cvc, 
        ]
    ];
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "https://api.magpie.im/v1/tokens");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($cardObj));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Accept: application/json",
        "Authorization: Basic " . $header
      ));
      $response = curl_exec($ch);
    curl_close($ch);
    return $response; 
}); 