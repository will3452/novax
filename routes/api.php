<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Imports\GradeImport;
use App\Models\Announcement;
use App\Models\Comment;
use App\Models\Post;
use App\Models\TeachingLoad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

//private access
Route::middleware('auth:sanctum')->group(function () {

    // posts
    Route::get('/posts', fn() => Post::with('user')->latest()->get());
    Route::post('/posts', function (Request $request) {
        return auth()->user()->posts()->create($request->all());
    });

    //comments
    Route::get('/comments', fn(Request $request) => Comment::with('user')->where(['commentable_type' => $request->type, 'commentable_id' => $request->id])->get());

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

Route::post('/upload', function (Request $request) {
    // Excel::import(new GradeImport, $request->file('template'));
    return $request->template->store('public');
});

Route::post('/import', function (Request $request) {
    Excel::import(new GradeImport, storage_path("app/$request->template"));
    return ['message' => 'ok'];
});

Route::post('/comments', function (Request $request) {
    $data = $request->all();
    $data['commentable_type'] = Announcement::class;
    return Comment::create($data);
});

Route::post('/load/{load}', function (Request $request, TeachingLoad $load) {
    $data = $request->validate([
        'description' => '',
    ]);
    $load->update($data);
    return 1;
});
