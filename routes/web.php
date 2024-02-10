<?php

use App\Models\Post;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Models\Feedback;
use App\Models\Inquiry;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about'); 
})->name('about'); 

Route::get('/map', function () {
    return view('map'); 
})->name('map'); 

Route::get('/destinations', function () {
    $destinations = Destination::paginate(10); 
    return view('destinations', compact('destinations')); 
})->name('destinations'); 

Route::get('/blogs', function () {
    $posts = Post::latest()->paginate(10); 
    return view('blogs', compact('posts')); 
})->name('blogs'); 

Route::get('/blog/{post}', function (Post $post) {
    return view('blog', compact('post')); 
}); 

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

Route::post('/inquiry', function (Request $request) {
    $data = $request->all(); 
    Inquiry::create($data);
    alert()->success('Your Inquiry has been sent to the administrator!.'); 
    return back(); 
}); 

Route::post('/feedback', function (Request $request) {
    $data = $request->all(); 
    Feedback::create($data);
    alert()->success('Your Feedback has been submitted!'); 
    return back(); 
}); 

Route::get('/search', function (Request $request) {
    $keyword = $request->keyword; 
    $destinations = Destination::where("name", "LIKE", "%$keyword%")->paginate(10); 

    return view('destinations', compact('destinations')); 
}); 

Route::get('/attractions/{attraction}', function (Destination $attraction) {
    $attraction->load(['category', 'photographs']); 
    return view('attraction', compact('attraction')); 
}); 

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
