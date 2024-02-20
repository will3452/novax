<?php

use App\Models\Job;
use App\Models\Blog;
use App\Models\Like;
use App\Models\User;
use App\Models\Event;
use App\Models\Alumnus;
use Illuminate\Http\Request;
use App\Models\ProfessionalRecord;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//private access
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::get('/me', function () {
        $user = User::find(auth()->id());
        $user->load(['alumnus.records']); 
        return $user; 
    }); 

    Route::post('/me', function (Request $request) {
        $key = $request->prop; 

        $value = $request->value; 

        auth()->user()->update([$key => $value]); 

        return 'ok'; 
    }); 

    Route::post('/add-record', function (Request $request) {

        $alumnus = Alumnus::whereUserId(auth()->id())->first(); 
        
        ProfessionalRecord::create([
            'alumnus_id' => $alumnus->id,
            'scope' => $request->scope, 
            'work_type' => $request->work_type, 
            'is_private' => $request->is_private, 
            'is_aligned' => $request->is_aligned, 
            'company' => $request->company,
            'company_address' => $request->company_address,
        ]); 

        return 'ok'; 
    }); 

    Route::post('/update-password', function (Request $request) {
        auth()->user()->update(['password' => bcrypt($request->new_password)]);
        $user = User::find(auth()->id());
        $user->email_verified_at = now();
        $user->save();  
        return 'ok'; 
    });

    Route::post('/blogs/{blog}/like', function (Blog $blog) { 

        $alreadyLike = Like::whereUserId(auth()->id())->whereBlogId($blog->id)->exists(); 

        if ($alreadyLike) {
            $blog->likers()->detach(auth()->id()); 
        } else {
            $blog->likers()->attach(auth()->id()); 
        }

        return 'ok'; 
    });
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::get('/blogs', function () {
    return Blog::with(['author', 'likers'])->latest()->get(); 
}); 

Route::get('/blogs/{blog}', function (Blog $blog) {
    $blog->load('author'); 
    return $blog; 
}); 

Route::get('/alumni', function () {
    return Alumnus::with(['user', 'records'])->latest()->get(); 
}); 

Route::get('/alumni/{alumnus}', function (Alumnus $alumnus) {
    $alumnus->load(['user', 'records']); 
    return $alumnus; 
}); 

Route::get('/jobs', function () {
    return Job::latest()->get(); 
}); 

Route::get('/jobs/{job}', function (Job $job) {
    return $job; 
}); 

Route::get('/events', function () {
    return Event::latest()->get(); 
}); 

Route::get('/events/upcoming', function () {
    return Event::where('start_at', '>', now())
        ->orderBy('start_at')->first(); 
});

Route::get('/events/{event}', function (Event $event) {
    return $event; 
}); 




