<?php

use App\Models\Activity;
use App\Models\StudentRecord;
use App\Models\TeachingLoad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $user = auth()->user();
    $user->load(['teachingLoads']);
    return $user;
});

Route::post('/announcements', function (Request $request) {
    $data = $request->validate([
        'title' => 'required',
        'body' => 'required',
        'teaching_load_id' => 'required',
    ]);

    return auth()->user()->announcements()->create($data);
});

Route::get('/teaching-loads/{load}', function (Request $request, TeachingLoad $load) {
    $load->with(['announcements' => function ($query) {
        return $query->latest();
    }]);
    return $load;
});

Route::post('/new-student', function (Request $request) {
    $data = $request->validate([
        'student_id' => 'required',
        'subject_id' => 'required',
        'teacher_id' => '',
        'academic_year_id' => 'required',
        'teaching_load_id' => 'required',
        'semester_id' => 'required',
    ]);

    $exists = StudentRecord::where($data)->exists();

    if ($exists) {
        return abort(400, 'student already exist!');
    }

    $data['teacher_id'] = auth()->id();
    return StudentRecord::create($data);
});

Route::post('/remove-student', function (Request $request) {
    return StudentRecord::where(['student_id' => $request->student_id, 'teaching_load_id' => $request->teaching_load_id])->delete();

});

Route::get('/students', function (Request $request) {
    return User::whereType(User::TYPE_STUDENT)->with('profile')->get();
});

Route::post('/new-activity', function (Request $request) {
    $data = $request->validate([
        'description' => 'required',
        'category' => 'required',
        'term' => 'required',
        'max_score' => 'required',
        'teaching_load_id' => 'required',
        'type' => 'required',
    ]);

    return Activity::create($data);
});

Route::post('/remove-activity/{a}', function (Request $request, Activity $a) {
    return $a->delete();
});

Route::post('/update-activity/{a}', function (Request $request, Activity $a) {
    $data = $request->validate([
        'description' => 'required',
        'category' => 'required',
        'term' => 'required',
        'max_score' => 'required',
        'teaching_load_id' => 'required',
        'type' => 'required',
    ]);
    return $a->update($data);
});
