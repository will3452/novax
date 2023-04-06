<?php

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;



//private access
Route::middleware('auth:sanctum')->group(function () {

    // posts
    Route::get('/posts', fn () => Post::with('user')->latest()->get());
    Route::post('/posts', function (Request $request) {
        return auth()->user()->posts()->create($request->all());
    });

    //comments
    Route::get('/comments', fn(Request $request) => Comment::with('user')->where(['commentable_type' => $request->type, 'commentable_id' => $request->id])->get());
    Route::post('/comments', function (Request $request) {
        return auth()->user()->comments()->create($request->all());
    });

    Route::get('/auth-test', function () {
        return 'authentication test';
    });

    Route::get('/user', function () {
        return ['user' => auth()->user()];
    });

    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);
