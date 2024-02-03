<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Blog;
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

    Route::get('/me', function () {
        return auth()->user(); 
    }); 
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::get('/blogs', function () {
    return Blog::with('author')->latest()->get(); 
}); 

Route::get('/blogs/{blog}', function (Blog $blog) {
    $blog->load('author'); 
    return $blog; 
}); 

