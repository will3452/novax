<?php

use App\Models\Group;
use App\Models\Progress;
use Illuminate\Http\Request;
use App\Exports\MonitoringReports;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProgressController;
use App\Models\OralDefenseRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TitleController;
use App\Models\Comment;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

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
    Route::get('/{title}/verdict', [TitleController::class, 'setVerdict'])->name('set.verdict');
    Route::post('/verdict', [TitleController::class, 'storeVerdict'])->name('store.verdict');
});

Route::middleware(['auth'])->prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::post('/', [NewsController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::post('/approve/{task}', [TaskController::class, 'approve'])->name('approve');
    Route::get('/{task}', [TaskController::class, 'reasonReject'])->name('reject');
    Route::post('/{task}', [TaskController::class, 'storeReasonAndReject'])->name("reason.reject");
});

Route::middleware('auth')->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::get('/read/{n}', [NotificationController::class, 'read'])->name('read');
    Route::get('/read-all', [NotificationController::class, 'readAll'])->name('read.all');
});


Route::middleware('auth')->prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::post('/', [CourseController::class, 'store'])->name('store');
});

Route::middleware('auth')->prefix('progress')->name('progress.')->group(function () {
    Route::post('/', [ProgressController::class, 'store'])->name('store');
});

Route::middleware('auth')->prefix('calendars')->name('calendars.')->group(function () {
    Route::get('/', function (Request $request) {
        return view('calendar');
    });
});

Route::middleware('auth')->prefix('revisions')->name('revisions.')->group(function () {
    Route::post('/', [RevisionController::class, 'store'])->name('store');
});




Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::post('/comment', function (Request $request) {
    $data = $request->validate([
        'group_id' => ['required'],
        'value' => ['required'],
    ]);

    $data['user_id'] = auth()->id();
    $data['reply_to_id'] = 1;

    Comment::create($data);

    return back()->withSuccess('Comment has been posted.');
});

Route::post('/settings', function(Request $request) {
    $data = $request->validate([
        'coordinator_id' => ['required'],
        'term' => ['required'],
        'school_year' => ['required'],
        'programchair_id' => ['required'],
    ]);

    $settings = ['coordinator_id', 'term', 'school_year', 'programchair_id'];
    foreach ($settings as $value) {
        $s = DB::table('nova_settings')->where('key', $value)->first();
        if ($s) {
            DB::table('nova_settings')->where('key', $value)->update(['value' => $data[$value]]);
        } else {
            DB::table('nova_settings')->insert([
                'key' => $value,
                'value' => $data['value'],
            ]);
        }
    }




    return back()->withSuccess('Settings has been saved!');
});

Route::get('/app/login', function () {
    return redirect()->to('/');
});

Route::post('/user-edit', function (Request $request) {
    $data = request()->all();
     $opath = $request->signature->store('public');
     $arr = explode('/', $opath);
     $data['signature'] = end($arr);
    //  dd($data);
    auth()->user()->update($data);
    return back()->withSuccess('Profile has been updated!');
})->name('user.update');

Route::get('/user-edit', function () {
    return view('user-edit');
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
