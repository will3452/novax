<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Attempt;

//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function () {
        return 'authentication test';
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::post('/save-video', function (Request $request) {
    $file = $request->file('file');
    $path = Storage::disk('local')->path("{$file->getClientOriginalName()}");

    File::append($path, $file->get());
    $name = '';
    if ($request->has('is_last') && $request->boolean('is_last')) {
        $name = basename($path, '.part');

        File::move($path,storage_path("app\\public\\" . $name));

        Attempt::find($request->attempt_id)->update(['video'=>$name]);
    }

    return response()->json(['uploaded' => true, 'name' => $name]);
});
