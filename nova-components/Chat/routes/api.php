<?php

use App\Models\User;
use App\Models\Message;
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

// Route::get('/endpoint', function (Request $request) {
//     //
// });

Route::get('/messages', function (Request $request) {
    $members = [auth()->id(), 1];
    if (auth()->id() == 1) {
        $members = [1];
    }
    if ($request->patient) {
        $members[] = $request->patient;
    }
    if (auth()->id() != 1) {
        return Message::whereSenderId(auth()->id())->orWhere('receiver_id', auth()->id())->get();
    }
    return Message::whereIn('sender_id', $members)->whereIn('receiver_id', $members)->get();
});

Route::get('/me', function (Request $request) {
    return auth()->id();
});

Route::post('/messages', function (Request $request) {
    $message = Message::create(['message' => $request->message, 'sender_id' => auth()->id(), 'receiver_id' => $request->receiver ?? 1]);
    return $message;
});
Route::get('/patients', function (Request $request) {
    return User::get();
});
