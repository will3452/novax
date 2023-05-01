<?php

use App\Models\Activity;
use App\Models\Score;
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

Route::post('/update-record/{record}', function (Request $request, StudentRecord $record) {
    $record->update($request->all());
});

Route::post('/generate-grade/{load}', function (Request $request, TeachingLoad $load) {

    foreach ($load->studentRecords as $sr) {
        $student = User::find($sr->student_id);
        $sr->update([
            'total_grade' => $student->getFinalGrade($load->id),
            'final_grade' => $student->getTermGrade($load->id, 'Final'),
            'pre_final_grade' => $student->getTermGrade($load->id, 'Pre-Final'),
            'midterm_grade' => $student->getTermGrade($load->id, 'Midterm'),
            'prelim_grade' => $student->getTermGrade($load->id, 'Prelim'),
            'remarks' => $student->getFinalGrade($load->id) >= 75 ? 'PASSED' : 'FAILED',
        ]);
    }

    return 1;
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

Route::post('/update-score', function (Request $request) {
    $activity = Activity::find($request->activity_id);
    $exists = Score::where(['activity_id' => $request->activity_id, 'student_id' => $request->student_id])->exists();

    $data = [
        'activity_id' => $activity->id,
        'student_id' => $request->student_id,
        'teaching_load_id' => $request->teaching_load_id,
        'score' => $request->score,
        'max_score' => $activity->max_score,
    ];

    if (!$exists) {
        return Score::create($data);
    }

    return Score::where(['activity_id' => $request->activity_id, 'student_id' => $request->student_id])->update($data);
});
