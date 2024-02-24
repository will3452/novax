<?php

use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReportController;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Log;

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


function sendMessage($number, $otp) {
    info("otp -> $otp"); 
    $ch = curl_init();
    $parameters = array(
        'apikey' => env('SMS_KEY'), //Your API KEY
        'number' => $number,
        'message' => "Your otp is $otp",
        'sendername' => 'SEMAPHORE'
    );
    curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
    curl_setopt( $ch, CURLOPT_POST, 1 );

    //Send the parameters set above with the request
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

    // Receive response from server
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $output = curl_exec( $ch );
    curl_close ($ch);

    //Show the server response
}

Route::post('/admin-login', function (Request $request) {
    $data = $request->validate([
        'email' => ['required', 'email', 'exists:users,email'], 
        'password' => ['required'], 
    ]); 
    $user = User::whereEmail($data['email'])->first(); 
    if (Hash::check($data['password'], $user->password)) {
        $code = Str::random(6); 
        sendMessage($user->phone, $code);
        User::whereEmail($data['email'])->update(['code' => $code]); 
        return redirect()->to('phone-code?user_id=' . $user->id); 
    }

    return 'Unauthorized!'; 
}); 

Route::view('phone-code', 'phone-code'); 

Route::post('/verify-code', function (Request $request) {
    $data = $request->validate([
        'code' => 'required',
        'user_id' => 'required', 
    ]); 
    
    $user = User::findOrFail($data['user_id']); 

    if ($user->code != $data['code']) return 'Unauthorized!'; 
    auth()->loginUsingId($user->id);

    AuditLog::create([
        'user_id' => auth()->id(), 
        'activity' => 'Login', 
    ]); 

    if ($request->has('redirect_path')) return redirect()->to($request->redirect_path); 

    return redirect()->to('/admin/dashboards/main'); 
}); 
