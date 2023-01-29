<?php

use App\Http\Controllers\BotManController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', fn () => redirect()->to('/home'));


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('/change-password', function (Request $request) {
        $request->validate([
            'password' => ['required']
        ]);

        $password = bcrypt($request->password);

        auth()->user()->update(['password' => $password]);

        alert()->success('Password has been changed!');
        return back();
    });

});

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
