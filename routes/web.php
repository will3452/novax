<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Models\Destination;
use App\Models\Post;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about'); 
})->name('about'); 

Route::get('/destinations', function () {
    $destinations = Destination::paginate(10); 
    return view('destinations', compact('destinations')); 
})->name('destinations'); 

Route::get('/blogs', function () {
    $posts = Post::latest()->paginate(10); 
    return view('blogs', compact('posts')); 
})->name('blogs'); 

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
