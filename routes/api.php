<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Collection;
use App\Models\Faq;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

     // DIARIES
     Route::prefix('/diary')->group(function () {
        Route::get('/', function (Request $request) {
            return auth()->user()->diaries()->latest()->get();
         });

        Route::post('/', function (Request $request) {
            $data = $request->validate([
                'title' => 'required',
                'body' => 'required'
            ]);

            return auth()->user()->diaries()->create($data);
        });
     });

     // Collections

     Route::prefix('/collections')->group(function () {
        Route::get('/', function () {
            return Collection::with('plant')->whereUserId(auth()->id())->latest()->get();
        });

        Route::post('/', function (Request $request) {
            $data = $request->validate([
                'plant_id' => ['required'],
            ]);

            $exists = Collection::whereUserId(auth()->id())->wherePlantId($data['plant_id'])->exists();
            if ($exists) {
                return response()->json(['message' => 'Plant was already in your collection list.'], 400);
            }
            $data['user_id'] = auth()->id();
            return Collection::create($data);
        });

        Route::delete('/{plant}', function (Request $request,Plant $plant) {

            $exists = Collection::whereUserId(auth()->id())->wherePlantId($plant->id)->exists();

            if (!$exists) {
                return response()->json(['message' => 'Plant not found!'], 400);
            }

            $result = Collection::whereUserId(auth()->id())->wherePlantId($plant->id)->first()->delete();

            return $result;
        });
     });


});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

// public
Route::get('/faq', function (Request $request) {
    return Faq::latest()->get();
});

Route::get('/plants', function () {
    return Plant::latest()->get();
});
