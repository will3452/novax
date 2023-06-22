<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Collection;
use App\Models\Faq;
use App\Models\Plant;
use App\Models\Task;
use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::prefix('/suggested-plants')->group(function () {
        Route::get('/', function (Request $request) {
            return auth()->user()->suggestedPlants()->latest()->get();
        });

        Route::post('/', function (Request $request) {
            $data = $request->validate([
                'common_name' => 'required',
                'scientific_name' => 'required',
                'image' => 'image',
            ]);

            $path = $data['image']->store('public');

            $arrayPath = explode('/', $path);

            $data['image'] = end($arrayPath);

            return auth()->user()->suggestedPlants()->create($data);
        });
    });

    // Tasks
    Route::prefix('/tasks')->group(function () {
        Route::get('/', function (Request $request) {
            return auth()->user()->tasks()->latest()->get();
        });

        Route::post('/', function (Request $request) {
            $data = $request->validate([
                'description' => 'required',
                'remarks' => '',
                'from' => 'required',
                'to' => 'required',
                'time' => 'required',
            ]);

            return auth()->user()->tasks()->create($data);
        });

        Route::delete('/{task}', function (Request $request, Task $task) {
            return $task->delete();
        });
    });

    // DIARIES
    Route::prefix('/diary')->group(function () {
        Route::get('/', function (Request $request) {
            return auth()->user()->diaries()->latest()->get();
        });

        Route::post('/', function (Request $request) {
            $data = $request->validate([
                'title' => 'required',
                'body' => 'required',
                'image' => 'image',
            ]);

            $path = $data['image']->store('public');

            $arrayPath = explode('/', $path);

            $data['image'] = end($arrayPath);

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
            $data['status'] = 'Planted';
            return Collection::create($data);
        });

        Route::delete('/{plant}', function (Request $request, Plant $plant) {

            $exists = Collection::whereUserId(auth()->id())->wherePlantId($plant->id)->exists();

            if (!$exists) {
                return response()->json(['message' => 'Plant not found!'], 400);
            }

            $result = Collection::whereUserId(auth()->id())->wherePlantId($plant->id)->first()->delete();

            return $result;
        });

        Route::put('/{plant}', function (Request $request, Plant $plant) {

            $updated = Collection::whereUserId(auth()->id())->wherePlantId($plant->id)->update(['status' => $request->status]);

            return $updated;
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

Route::get('/plants', function (Request $request) {
    if ($request->search) {
        $props = explode(',', $request->search);
        $where = [];
        foreach ($props as $prop) {
            $arr = explode(':', $prop);
            $where[$arr[0]] = $arr[1];
        }

        return Plant::where($where)->get();
    }
    return Plant::latest()->get();
});

Route::get('/tips', function (Request $request) {
    return Tip::latest()->get();
});
