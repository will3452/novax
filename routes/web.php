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
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FileUploaderController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\EmailVerificationController;


//home
Route::redirect('/', '/register');
Route::redirect('/home', Nova::path());

//registration
Route::get('/register', [RegisterController::class, 'registerScholar']);
Route::post('/register', [RegisterController::class, 'registerScholarPost']);


//artisan helper -- turn the website down or up
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


// request for AAN



// email verification
Route::get('/send-email-verification-notification', [EmailVerificationController::class, 'resend']);
Route::get('/email-verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

//file uploader
Route::post('/upload-large-file', [FileUploaderController::class, 'upload']);

//contact us, to get aan, concerns,
Route::get('/contact-form', fn () => view('contact-form'));
Route::post('/contact-form', [InquiryController::class, 'submit']);
