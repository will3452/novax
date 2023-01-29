<?php

use App\Http\Controllers\BotManController;
use App\Models\Conversation;
use App\Models\Faculty;
use App\Models\MessageRequest;
use App\Models\Topic;
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

Route::middleware(['verified', 'auth'])->group(function () {

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


    Route::get('/topics', function () {
        $topics = Topic::get();

        return view('topics', compact('topics'));
    });

    Route::get('/faculties', function () {
        $f = Faculty::get();

        return view('faculties', compact('f'));
    });

    Route::get('/conversations', function () {
        $conversation = Conversation::whereUserId(auth()->id())->get();

        return view('conversations', compact('conversation'));
    });

    Route::get('/mr', function () {
        $mr = MessageRequest::whereFacultyId(auth()->user()->faculty->id)->latest()->get();
        return view('mr', compact('mr'));
    });

    Route::get('/chat', function (Request $request) {
        $user = null;

        if ($request->user) {
            $user = User::find($request->user);
        }
        return view('chat', compact('user'));
    });

});



Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
