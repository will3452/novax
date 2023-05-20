<?php

use App\Http\Controllers\RegisterController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to(route('nova.login'));
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/tasks', function (Request $request) {
    $q = $request->query;
    $qArr = [];
    foreach ($q as $key => $value) {
        $qArr[$key] = $value;
    }
    return Task::with(['project.classification', 'ticket.classification', 'createdBy', 'user', 'department'])->where($qArr)->latest()->get();
});

Route::post('/tasks', function (Request $request) {
    $status = $request->status;
    return Task::find($request->id)->update(['status' => $status]);
});
