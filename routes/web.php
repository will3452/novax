<?php

use App\Http\Controllers\AppsController;
use App\Http\Controllers\BmisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\TodoController;
use App\Models\Album;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('home'));
});

//dashboard
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::view('/profile', 'profile');
Route::post('/profile', function (Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'password' => 'required',
    ]);
    $data['password'] = bcrypt($data['password']);
    auth()->user()->update($data);
    return back()->withAlert('Updated!');
});


Route::get('/games', [GameController::class, 'index']);
//games
Route::get('games/sudoku', [GameController::class, 'sudoku']);
Route::get('games/flip-card', [GameController::class, 'flipCard']);
Route::view('games/chess', 'chess');

//gallery
Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('gallery/create', [GalleryController::class, 'create']);
Route::post('gallery', [GalleryController::class, 'store']);
Route::get('gallery/remove/{image}', [GalleryController::class, 'delete']);
Route::get('/images', [GalleryController::class, 'imageIndex']);
Route::post('/create-album', function (Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'description' => 'required',
    ]);
    $data['user_id'] = auth()->id();
    Album::create($data);

    return back()->withAlert('Success');
});

//apps controller
Route::get('/applications', [AppsController::class, 'index']);
Route::get('/bmi', [BmisController::class, 'index']);
Route::post('/bmi', [BmisController::class, 'store']);
Route::get('/tips', [TipController::class, 'index']);
Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'store']);
Route::post('/todo-complete/{todo}', [TodoController::class, 'markAsComplete']);
//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
