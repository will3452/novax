<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Mail;



Route::get('/verify-account', function (Request $request) {
    $phone = $request->phone;
    $email = $request->email;


    if ($phone) {
        $user = User::wherePhone($phone)->first();

        if (!$user) {
            alert()->warning('User not found!');

            return redirect('/');
        }

        auth()->login($user);

        $user->update(['verified_at' => now()]);

        alert()->success('Your account verified!');


        return redirect()->to('/home');
    }
    if ($email) {
        $user = User::whereEmail($email)->first();

        if (!$user) {
            alert()->warning('User not found!');

            return redirect('/');
        }

        auth()->login($user);

        $user->update(['verified_at' => now()]);

        alert()->success('Your account verified!');

        return redirect()->to('/home');
    }

    return 'Something went wrong.';
})->name('verify');

Route::get('/', function () {
    return redirect()->to(route('login'));
});

Route::get('/register', [RegisterController::class, 'registrationPage']);
Route::post('/register', [RegisterController::class, 'postRegister']);


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('records')->name('records.')->group(function () {
    Route::get('/', [RecordController::class, 'index'])->name('index');
    Route::post('/', [RecordController::class, 'store']);
});

Route::prefix('profiles')->name('profiles.')->group(function () {
    Route::get('/{user}', [ProfileController::class, 'show'])->name('show');
    Route::put('/preference/{user}', [ProfileController::class, 'savePreference'])->name('update.preferences');
    Route::put('/accounts/{user}', [ProfileController::class, 'saveAccount'])->name('update.account');
});

Route::prefix('foods')->name('foods.')->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('index');
});

Route::prefix('exercises')->name('exercises.')->group(function () {
    Route::get('/', [ExerciseController::class, 'index'])->name('index');
});

Route::prefix('activities')->name('activities.')->group(function () {
    Route::post('/add-activity', [ActivityController::class, 'addActivity'])->name('add');
    Route::get('/', [ActivityController::class, 'index'])->name('index');
});


Route::get('/verify', function (Request $request) {
    $phone = auth()->user()->phone;

    $email = auth()->user()->email;



    $link = route('verify', ['phone' => $phone, 'email' => $email]);

    if ($phone) {
        $ch = curl_init();
        $parameters = array(
            'apikey' => env('SMS_KEY'),
            'number' => $phone,
            'message' => 'Here\'s your verification link.' . $link,
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

    }

    if ($email) {
        Mail::raw( 'Here\'s your verification link.' . $link, function($message) use ($email) {
            $message->to($email)->subject('Account verification');
        });
    }

    alert()->success('Your verification link has been sent to your phone and email.');

    return back();
});
