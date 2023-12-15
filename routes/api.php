<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Category;
use App\Models\Sos;
use App\Models\User;
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

    Route::get('my-sos', function () {
        return auth()->user()->sos()->latest()->get();
    });

    Route::post('my-sos', function (Request $request) {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        if($request->has('file')) {
            $path = $request->file->store('public');
            $pathArr = explode('/', $path);
            $data['audio'] = end($pathArr); 
        }
        return Sos::create($data);
    });
});

Route::get('/public-test', function () {
    return 'public test';
});

Route::get('/users', function () {
    return User::get();
});

Route::get('/logo', function () {
    return nova_get_setting('logo');
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::get('/categories', function (Request $request) {
    return Category::with('injuries.steps')->latest()->get();
});

Route::get('/sos', function () {
    // return User::find(1)->sos()->latest()->get();
    return Sos::latest()->get();
});
