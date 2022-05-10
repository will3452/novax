<?php

use App\Exports\StudentGradedExport;
use App\Models\Exam;
use App\Models\Record;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TakeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminUserController;

Route::get('/', function () {
    return redirect('/login');
});

Route::view('/about', 'about');

Route::get('result', function (Request $request) {
    $record = Record::find($request->record_id);
    if (auth()->user()->id !== $record->user_id) {
        return abort(403);
    }
    $score = $record->score;
    return view('take_done', compact('record', 'score'));
});

Route::post('update-password', function(Request $request) {

    $data = $request->validate([
        'password' => ['confirmed', 'required'],
        'current_password' => 'required',
    ]);


    if (! Hash::check($data['current_password'], auth()->user()->password)) {
        return back()->withErrors('Invalid old password!');
    }
    auth()->user()->update(['password' => bcrypt($data['password'])]);

    return back()->withSuccess('success');
});

Route::post('update-picture', function(Request $request) {
    $request->validate([
        'picture' => ['image', 'required'],
    ]);

    $picture = $request->picture->store('public');
    $arr = explode('/', $picture);
    $endArr = end($arr);

    auth()->user()->update(['picture' => $endArr]);

    return back()->withSuccess('success');
});


// Route::get('/register', [RegisterController::class, 'registrationPage']);
// Route::post('/register', [RegisterController::class, 'postRegister']);

Route::prefix('password')->name('password.')->group(function () {
    Route::get('enter-email', [PasswordController::class, 'enterEmail'])->name('enter.email');
    Route::post('send-link', [PasswordController::class, 'requestPasswordResetLink'])->name('send.link');
    Route::get('reset-link/{passwordResetLink:uuid}',[PasswordController::class, 'showPasswordReset'])->name('reset.link');
    Route::post('reset-password/{passwordResetLink:uuid}', [PasswordController::class, 'resetPassword'])->name('reset.password');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware(['guest']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('auth');
Route::get('/exams', [ExamController::class, 'index'])->middleware('auth');
Route::get('/exam/create', [ExamController::class, 'create']);
Route::get('/exams/edit/{exam}', [ExamController::class, 'edit']);
Route::get('/exams/delete/{exam}', function (Exam $exam) {
    $exam->delete();
    return back();
});
Route::put('/exams/{exam}', [ExamController::class, 'update']);
Route::get('/exams/reports/{exam}', [ExamController::class, 'showReport'])->name('exam.report');
Route::get('/exams/result/{exam}', [ExamController::class, 'showRecords'])->name('exam.result');
Route::get('/exams/graded/{exam}', [ExamController::class, 'showGraded'])->name('exam.graded');
Route::get('/exams/no-grade/{exam}', [ExamController::class, 'showNoGrade'])->name('exam.nograde');
Route::get('/exams/not-yet/{exam}', [ExamController::class, 'showNotYet'])->name('exam.notyet');
Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exam.show');
Route::delete('/exams/{exam}', [ExamController::class, 'destroy']);
Route::post('/exams', [ExamController::class, 'store']);
Route::get('/account', [AccountController::class, 'getAccount']);
Route::get('/take-confirm/{exam}', function (Exam $exam) {
    return view('take-confirm', ['e' => $exam]);
});

// when teacher update the grade of the student base of the  given sanswers.
Route::post('/update-grade/{record}', function (Request $request, Record $record) {
    $points = 0;
    $grades = $request->status;
    $answers = $record->answers;
    foreach ($answers as $key => $a) {
        $a->update([
            'status' => $grades[$key],
        ]);
        $points += $grades[$key];
    }

    $record->update(['score' => $points]);
    return back()->withSuccess('Done!');
})->name('update.grade.of.record');

Route::post('/questions', [QuestionController::class, 'store']);
Route::get('/questions/delete/{question}', [QuestionController::class, 'destroy']);
Route::get('/questions/edit/{question}', [QuestionController::class, 'edit']);
Route::get('/questions/create/{exam}', [QuestionController::class, 'create']);
Route::put('/questions/{question}', [QuestionController::class, 'update']);
Route::delete('/questions/{question}', [QuestionController::class, 'destroy']);
Route::get('/print-q/{exam}', [QuestionController::class, 'printq']);

Route::get('extract-excel/{exam}', function (Request $request, Exam $exam) {
    $now = now()->format('m-d-y');
    return Excel::download(new StudentGradedExport($exam), "$exam->name-student-report-$now.xlsx");
});

Route::post('take-now/{exam}', [TakeController::class, 'takeNow']);
Route::get('take/{record}', [TakeController::class, 'take']);
Route::post('submit/{record}', [TakeController::class, 'submit']);

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/', [AdminUserController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [AdminUserController::class, 'update'])->name('update');
    });
});

Route::get('layout-test', function () {
    return view('layout-testing');
});
