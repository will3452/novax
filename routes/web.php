<?php

use App\Models\Group;
use App\Models\Progress;
use Illuminate\Http\Request;
use App\Exports\MonitoringReports;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProgressController;
use App\Models\OralDefenseRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TitleController;

Route::middleware(['auth'])->prefix('sections')->name('sections.')->group(function () {
    Route::get('/', [SectionController::class, 'index']);
    Route::get('/{section}', [SectionController::class, 'show'])->name('show');
    Route::post('/add-students', [SectionController::class, 'addStudent'])->name('add-student');
    Route::post('/remove-students', [SectionController::class, 'removeStudent'])->name('remove-student');
    Route::post('/', [SectionController::class, 'store']);
    Route::post('/title', [TitleController::class, 'store'])->name('submit-title');
});

Route::middleware(['auth'])->prefix('titles')->name('titles.')->group(function () {
    Route::get('/{title}', [TitleController::class, 'show'])->name('show');
    Route::post('/{title}/apply', [TitleController::class, 'apply'])->name('apply');
    Route::post('/{title}/add-panelist', [TitleController::class, 'addPanelist'])->name('add.panelist');
    Route::post('/{title}/remove-panelist', [TitleController::class, 'removePanelist'])->name('remove.panelist');
    Route::post('/{title}/lock-panelist', [TitleController::class, 'lockPanelist'])->name('lock.panelist');
    Route::post('/{title}/endorse', [TitleController::class, 'endorse'])->name('endorse.group');
    Route::post('/{title}/request-approval/{oral}', [TitleController::class, 'submitOral'])->name('submit.oral');
});

Route::middleware(['auth'])->prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::post('/approve/{task}', [TaskController::class, 'approve'])->name('approve');
    Route::post('/reject/{task}', [TaskController::class, 'reject'])->name('reject');
});

Route::middleware('auth')->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::get('/read/{n}', [NotificationController::class, 'read'])->name('read');
    Route::get('/read-all', [NotificationController::class, 'readAll'])->name('read.all');
});

Route::middleware('auth')->prefix('progress')->name('progress.')->group(function () {
    Route::post('/', [ProgressController::class, 'store'])->name('store');
});

Route::middleware('auth')->prefix('calendars')->name('calendars.')->group(function () {
    Route::get('/', function (Request $request) {
        return view('calendar');
    });
});


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/app/login', function () {
    return redirect()->to('/');
});

Route::get('/form', function (Request $request) {
    $response = [];
    if ($request->form == 'progress') {
        $progress = Progress::find($request->model);
        $progress->load('section', 'group');
        $response['progress'] = $progress;
    }

    if ($request->form == 'oral_defense') {
        $oral_defense = OralDefenseRequest::find($request->model);
        $oral_defense->load('section.course', 'group.title');
        $response['oral_defense'] = $oral_defense;
    }

    if ($request->form == 'acceptance' || $request->form == 'revision' || $request->form == 'rubric') {
        $group = Group::find($request->model);
        $group->load('title');
        $response['group'] = $group;
    }
    return view('form', $response);
})->name('form');


Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

Route::get('/download-monitoring', function () {
    return Excel::download(new MonitoringReports(), "monitoring-".nova_get_setting('term').".xlsx");
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
