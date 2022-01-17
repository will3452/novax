<?php

use App\Models\User;
use App\Models\Subject;
use App\Models\UserStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/rooms/{room}', [RoomController::class, 'show']);
Route::get('/subjects/{subject}', [SubjectController::class, 'show']);
Route::get('/quizzes/{quiz}', [QuizController::class, 'take']);
Route::post('/quizzes/{quiz}', [QuizController::class, 'calculate']);

Route::get('/exams/{exam}', [ExamController::class, 'take']);
Route::post('/exams/{exam}', [ExamController::class, 'calculate']);

Route::post('/mark-as-done', function () {
    $data = request()->validate([
        'module_id' => 'required',
        'subject_id' => 'required',
    ]);
    auth()->user()->userModules()->create([
        'module_id' => $data['module_id'],
        'subject_id' => $data['subject_id'],
    ]);
    return back();
});

Route::post('/add-student', function () {
    $data = request()->validate([
        'email'=>'required'
    ]);

    $user = User::where('email', $data['email'])->first();

    if ($user == null) {
        return back()->withError('No Student found');
    }

    if ($user->type != User::TYPE_STUDENT) {
        return back()->withError('Account is not student');
    }

    if (auth()->user()->userStudents()->where('student_id', $user->id)->count()) {
        return back()->withError('Account is already in the list!');
    }

    auth()->user()->userStudents()->create([
        'student_id' => $user->id,
    ]);

    return back()->withSuccess('Account added to your student list');
});


Route::get('/remove-student', function () {
    $data = request()->validate([
        'student_id'=>'required'
    ]);

    $record = auth()->user()->userStudents()->where('student_id', $data['student_id'])->first();
    $record->delete();
    return back();
});

Route::get('/view-progress/{student}', function (User $student) {
    $subject = null;
    return view('view-progress', compact('student', 'subject'));
});


Route::post('/load-report', function () {
    $data = request()->validate([
        'student_id' => 'required',
        'subject_id' => 'required',
    ]);

    $student = User::find($data['student_id']);
    $subject = Subject::find($data['subject_id']);

    return view('view-progress', compact('student', 'subject'));
});


Route::post('/update', function (Request $request) {
    $payload = request()->validate([
        'password' => ['required', 'confirmed'],
    ]);

    auth()->user()->update(['password' => bcrypt($payload['password'])]);
    return back();
});
