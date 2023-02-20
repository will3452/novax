<?php

use App\Models\Billing;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rooms/{room}', function(Request $request, Room $room) {
    return view('room', compact('room'));
});

Route::middleware(['auth'])->group(function () {

    Route::get('/transactions', function (Request $request) {
        return view('billings', ['billings' => Billing::wherePayerId(auth()->id())->latest()->get()]);
    });

    Route::get('/booking/{room}', function(Request $request, Room $room) {
        return view('booking', compact('room'));
    });

    Route::post('/booking/{room}', function(Request $request, Room $room) {
        $data = [
            'mobile' => $request->mobile,
            'date' => $request->date,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'room_id' => $room->id,
        ];

        Booking::create($data);
        alert()->success('Booking has been submitted!');

        return redirect('/home');
    });


    Route::post('review/{room}', function(Request $request, Room $room) {
        $data = [
            'message' => $request->message,
            'star' => $request->star,
            'user_id' => auth()->id(),
            'room_id' => $room->id,
        ];


        Review::create($data);

        alert()->success('Review has been added!');

        return back();
    });

});


Route::get('/s', function(Request $request) {
    $rooms = Room::where('name', 'LIKE', "%$request->name%")->get();
    return view('search', compact('rooms'));
});

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::get('/logout', function () {
    auth()->logout();

    return redirect('/');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('about', 'about');
