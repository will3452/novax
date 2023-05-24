<?php

use App\Http\Controllers\RegisterController;
use App\Models\Award;
use App\Models\Department;
use App\Models\Task;
use App\Models\TaskActivity;
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

    $department = Department::whereHeadId(auth()->id())->first();
    $d = [];

    if ($department) {
        $qArr['department_id'] = $department->id;
        return Task::with(['project.classification', 'ticket.classification', 'createdBy', 'user', 'department', 'taskActivities'])->where($qArr)->latest()->get();
    }

    $qArr['user_id'] = auth()->id();

    return Task::with(['project.classification', 'ticket.classification', 'createdBy', 'user', 'department', 'taskActivities'])->where($qArr)->latest()->get();
});

Route::post('/tasks', function (Request $request) {
    $status = $request->status;
    $user = auth()->user()->name;
    TaskActivity::create(['task_id' => $request->id, 'description' => "$user moved to $status", 'user_id' => auth()->id()]);
    return Task::find($request->id)->update(['status' => $status]);
});

Route::get('/certificate/{award}', function (Award $award) {
    return view('certificate', compact('award'));
});
