<?php

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/register');
})->middleware(['auth']);


Route::middleware(['auth'])->group(function () {
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::post('/', [ReportController::class, 'store'])->name('store'); 
    }); 


    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('index'); 
        Route::get('/{post}', [NewsController::class, 'show'])->name('show'); 
    });


    Route::prefix('organization')->name('organizations.')->group(function () {
        Route::view('/', 'organization');
    }); 
});


Route::view('anonymous', 'anonymous'); 

Route::post('anonymous', function (Request $request) {
    $data = $request->validate([
        'category_id' => ['required'],
        'description' => ['required'],
        'image' => ['image', 'required', 'max:5000'],
        'lat' => ['required'],
        'lng' => ['required'], 
    ]);

    if ($request->token == null) {
        alert()->error('Error', 'Invalid token'); 
        return back(); 
    }

    $user = User::whereToken($request->token)->first();

    if (! $user) {
        alert()->error('Error', 'invalid token!'); 
        return back(); 
    }

    // save the image 
    $full_image_path = $request->image->store('public'); 
    
    $array_image_path = explode('/', $full_image_path);

    $data['image'] = end($array_image_path); 

    // attach some props 
    $data['user_id'] = $user->id; 


    Report::create($data); 
    
    alert()->success('Success', 'Report has been submitted!'); 

    return back(); 
});
