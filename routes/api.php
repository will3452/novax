<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Imports\GradeImport;
use App\Imports\ScoreImport;
use App\Models\AcademicYear;
use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentRecord;
use App\Models\Subject;
use App\Models\TeachingLoad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

//private access
Route::middleware('auth:sanctum')->group(function () {

    // posts
    Route::get('/posts', fn() => Post::with('user')->latest()->get());
    Route::post('/posts', function (Request $request) {
        return auth()->user()->posts()->create($request->all());
    });

    //comments
    Route::get('/comments', fn(Request $request) => Comment::with('user')->where(['commentable_type' => $request->type, 'commentable_id' => $request->id])->get());

    Route::get('/auth-test', function () {
        return 'authentication test';
    });

    Route::get('/user', function () {
        return ['user' => auth()->user()];
    });

    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::post('/upload', function (Request $request) {
    // Excel::import(new GradeImport, $request->file('template'));
    return $request->template->store('public');
});

Route::post('/import', function (Request $request) {
    Excel::import(new GradeImport, storage_path("app/$request->template"));
    return ['message' => 'ok'];
});

Route::post('/comments', function (Request $request) {
    $data = $request->all();
    $data['commentable_type'] = Announcement::class;
    return Comment::create($data);
});

Route::post('/load/{load}', function (Request $request, TeachingLoad $load) {
    $data = $request->validate([
        'description' => '',
    ]);
    $load->update($data);
    return 1;
});

Route::post('/upload-record', function (Request $request) {
    $data = json_decode($request->data);
    $activity = Activity::find($data->activity_id);
    // Retrieve the FileBag instance from the request
    $fileBag = $request->files;
    $files = [];

    // Check if the FileBag has any files
    if ($fileBag->count() > 0) {
        // Iterate through each uploaded file
        foreach ($fileBag as $file) {
            // Access file properties and perform operations
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileExtension = $file->getClientOriginalExtension();
            $file->move('storage', $fileName);
            Excel::import(new ScoreImport($activity), storage_path("app/public/$fileName"));
        }
    }

    return $files;
});

Route::get('/students', function (Request $request) {
    return User::whereType(User::TYPE_STUDENT)->with('profile')->get();
});

Route::get('/semester', function (Request $request) {
    return Semester::get();
});

Route::post('/submit-grade-of-student', function (Request $request) {
    $student = Student::find($request->student_id);
    if (!$student) {
        return response('error', '400');
    }
    $added = 0;
    $semester = Semester::find($request->semester_id);
    if (!$semester) {
        return response('error', '400');
    }
    foreach ($request->grades as $grade) {
        if (array_key_exists('code', $grade)) {
            $subject = Subject::whereCode($grade['code'])->first();

            if (!$subject) {
                return response('error', '400');
            }

            StudentRecord::create([
                'subject_id' => $subject->id,
                'student_id' => $student->id,
                'academic_year_id' => AcademicYear::active()->id ?? null,
                'semester_id' => $semester->id,
                'teacher_id' => auth()->id(),
                'total_grade' => $grade['grade'],
            ]);

            $added++;
        }
    }

    return response($added, '200');
});
