<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoomController;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::post('/join-room', [RoomController::class, 'joinRoom']);

Route::post('/save', function (Request $request) {
    $data = $request->validate([
        'file' => ['required', 'image'],
        'lecture_id' => ['required'],
    ]);

    $data['file'] = $data['file']->store('public');

    $data['file'] = str_replace('public/', '/storage/', $data['file']);

    $data['user_id'] = auth()->id();

    return Record::create($data);
});

Route::post('update/', function (Request $request) {
    return Record::whereFile($request->file)->first()->update(['file' => $request->emotion]);
});
