<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/
Route::get('/', function (Request $request) {
    return [
        'count' => Post::where('author_id', $request->user()->id)->count(),
    ];
});

Route::delete('posts/{post}', function (Request $request, Post $post) {
    $post->delete();
    return [
        'posts' => Post::where('author_id', $request->user()->id)->get(),
    ];
});


Route::get('posts', function (Request $request) {
    return [
        'posts' => Post::where('author_id', $request->user()->id)->get(),
    ];
});

Route::post('posts', function (Request $request) {
    Post::create([
        'author_id' => $request->user()->id,
        'title' => $request->title,
        'body' => $request->body,
    ]);
    return [
        'posts' => Post::where('author_id', $request->user()->id)->get(),
    ];
});
