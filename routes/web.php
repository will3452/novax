<?php

use App\Models\Club;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\College;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\EmailVerificationController;

Route::redirect('/', '/register');
Route::redirect('/home', Nova::path());

Route::get('/register', [RegisterController::class, 'registerScholar']);

Route::post('/register', [RegisterController::class, 'registerScholarPost']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


//ajax requests
Route::get('/colleges', fn () =>
    College::get()
);

Route::get('/courses', fn () =>
    Course::whereCollegeId(request()->college_id)->get()
);

Route::get('/clubs', fn () =>
    Club::whereCollegeId(request()->college_id)->get()
);

Route::get('/send-email-verification-notification', [EmailVerificationController::class, 'resend']);
Route::get('/email-verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

Route::post('/upload-large-file', function (Request $request) {
    $file = $request->file('file');
    $path = Storage::disk('local')->path("{$file->getClientOriginalName()}");

    File::append($path, $file->get());
    $file = "";
    $isDone = false;
    if ($request->has('is_last') && $request->boolean('is_last')) {
        $name = basename($path, '.part');
        $file = storage_path('app\\public\\' . $name);
        File::move($path, $file);
        $file = $name;
        $isDone = true;
    }

        return response()->json([
            'uploaded' => true,
            'is_done' => $isDone,
            'file' => $file,
        ]);
});
