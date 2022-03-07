<?php

use App\Exports\RoomsExport;
use App\Exports\SubjectsExport;
use App\Exports\UsersExport;
use App\Exports\YearLevelExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TakeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Nova\LoginController as NovaLoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportIssueController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::post(Nova::path() . '/login', [NovaLoginController::class, 'login'])->name('nova.login');

Route::prefix('teacher')->name('teacher.')->middleware(['auth'])->group(function () {
    //rooms
    Route::get('/room', [RoomController::class, 'teacherRoom'])->name('room');
});

Route::prefix('student')->name('student.')->middleware(['auth'])->group(function () {
    //rooms
    Route::get('/room', [RoomController::class, 'studentRoom'])->name('room');
});

//subjects
Route::get('/subjects/{subject}', [SubjectController::class, 'show']);

//records
Route::get('/save-records/{type}/{id}/{userId}', [RecordController::class, 'saveRecord']);
Route::get('/view-records/{type}/{id}', [RecordController::class, 'show']);
Route::post('/update-score/{record}', [RecordController::class, 'updateScore']);

//taking activities controller
Route::get('/take/{category}/{id}', [TakeController::class, 'take']);
Route::post('/submit-project/{activity}', [TakeController::class, 'submitProject']);
Route::post('/submit-answers/{activity}', [TakeController::class, 'submitAnswer']);

Route::view('/home', 'home')->middleware(['auth']);

Route::view('/forgot-password', 'forgotpassword');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);

Route::get('/profile', [ProfileController::class, 'profile']);
Route::post('/profile', [ProfileController::class, 'update']);

Route::get('/report-issue', [ReportIssueController::class, 'create']);
Route::post('/report-issue', [ReportIssueController::class, 'store']);

Route::post('/submit-feedback', [FeedbackController::class, 'store']);

Route::get('/report', function () {
    if (request()->get('data') === 'users') {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    if (request()->get('data') === 'subjects') {
        return Excel::download(new SubjectsExport, 'subjects.xlsx');
    }

    if (request()->get('data') === 'rooms') {
        return Excel::download(new RoomsExport, 'rooms.xlsx');
    }

    if (request()->get('data') === 'year-level') {
        return Excel::download(new YearLevelExport, 'yearlevels.xlsx');
    }
});

// Route::get('/feedback', []);
//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});
