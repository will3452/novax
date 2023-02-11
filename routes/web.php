<?php

use App\Models\Profile;
use App\Models\RequestLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::get('/logout', function () {
    auth()->logout();
    return back();
})->name('nova.logout');


Route::get('/issue-documents', function (Request $request) {
    $profile = Profile::find($request->profile);

    $doc = '';

    if ($request->document == 'INDEGENT CERTIFICATE') {
        $doc = 'indigency';
    }

    if ($request->document == 'CLEARANCE') {
        $doc = 'clearance';
    }

    if ($request->document == 'BUSINESS PERMIT') {
        $doc = 'business';
    }


    if ($doc == '') {
        return 'not found!';
    }

    $reference = Str::random(16);

    if (auth()->check()) {
        RequestLog::create([
            'document' => $request->document,
            'user_id' => auth()->id(),
            'profile_id' => $request->profile,
            'reference' => $reference,
        ]);
    }

    return view($doc,  compact('profile', 'reference'));
})->name('issue');


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


Route::get('/validate', function (Request $request) {
    if (! $request->ref) return 'Invalid request!';
    $valid = RequestLog::whereReference($request->ref)->exists();
    $copy = RequestLog::whereReference($request->ref)->first();
    return view('validation', compact('valid', 'copy'));
})->name('validate');
