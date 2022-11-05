<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PuzzleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\StoryModeController;
use App\Models\UnVerifiedUser;
use App\Models\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/story-mode', [StoryModeController::class, 'index']);
Route::get('/story-mode/{story}', [StoryModeController::class, 'show']);
Route::get('quiz-now/{story}', [StoryModeController::class, 'quiz']);
Route::get('/puzzle', [PuzzleController::class, 'index']);
Route::view('/game-index', 'game_index');
Route::get('/matching', [PuzzleController::class, 'matching']);
Route::get('/scene/{scene}', [SceneController::class, 'show']);

Route::get('/verify/user/', function (Request $request) {
    try {
        if (! $request->has('p')) throw new Exception('Invalid request');

        $user = UnVerifiedUser::wherePassword($request->p)->first();

        if (!$user) throw new Exception('Invalid request');

        $user = User::create([
            'name' => $user->name,
            'password' => $user->password,
            'email' => $user->email,
        ]);

        UnVerifiedUser::wherePassword($request->p)->first()->delete();

        return 'user has been verified!';
    } catch (Exception $e) {
        return $e->getMessage();
    }
})->name('account.verify');
