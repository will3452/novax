<?php

use App\Models\Booking;
use App\Models\Receipt;
use App\Models\Feedback;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Route as ModelsRoute;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\User;

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
    Route::get('/auth-test', function () {
        return 'authentication test';
    });

    Route::get('/booking-filter', function(Request $request) {
        $data = $request->validate([
            'route_id' => 'required',
            'date' => 'required',
        ]); 
        $scheduleId = $request->time; 
        return Booking::with(['route.schedules', 'user'])
            ->whereHas('route', function($query) use ($scheduleId) {
                $query->whereHas('schedules', function ($q) use ($scheduleId) {
                    $q->whereId($scheduleId);
                });
            })
            ->where($data)
            ->get(); 
    });

    Route::post('/booking', function (Request $request) {
        // check if has balance 
        // $inTransactions = auth()->user()->transactions()->whereBound('IN')->sum('amount'); 
        // $outTransactions = auth()->user()->transactions()->whereBound('OUT')->sum('amount'); 

        // $totalBalance = $inTransactions - $outTransactions; 
        
        // if ($inTransactions - $outTransactions <= 0) return ['message' => 'no balance']; 

        $file = null; 

        if ($request->hasFile('file')) {
            $filePath = $request->file->store('public'); 

            $filePathArray = explode('/', $filePath); 
            $file = end($filePathArray); 
        }

        $schedule = Schedule::find($request->schedule_id);

        $passenger = $request->passenger; 
        
        $fare = $schedule->route->fare + $schedule->bus->additional_fee; 

        // $totalCharges = $passenger * $fare; 

        // if ($totalCharges > $totalBalance) return ['message' => 'not enough balance']; 

        $booking = Booking::create([
            'status' => 'FOR CONFIRMATION', 
            'from' => $schedule->route->from->name, 
            'to' => $schedule->route->to->name, 
            'fare' => $fare,
            'user_id' => auth()->id(),
            'qty' => $passenger, 
            'date' => $request->date, 
            'seat_numbers' => 'TBF', 
            'route_id' => $schedule->route_id, 
            'time' => $schedule->departure, 
            'schedule_id' => $schedule->id, 
            'discount' => 0, 
            'file' => $file, 
            'passengers' => $request->passengers, 
        ]); 


        // // add transaction
        // Transaction::create([
        //     'type' => 'PAYMENT',
        //     'bound' => 'OUT',
        //     'amount' => $totalCharges,
        //     'user_id' => auth()->id(),
        //     'status' => 'APPROVED',
        // ]);

        return ['message' => 'success', 'booking' => $booking]; 
    }); 

    Route::post('/feedback', function (Request $request) {
        $request->validate([
            'comment' => 'required', 
            'star' => 'required', 
        ]); 
        $data = [
            'body' => $request->comment, 
            'category' => $request->star, 
            'user_id' => auth()->id(), 
        ];

        return Feedback::create($data); 
    });


    Route::post('send-otp', function(Request $request) {
        $code = Str::random(6); 
        auth()->user()->update(['code' => $code]);  
        Mail::raw("Your OTP is code is $code", function ($message) use($request) {
            $message->subject('OTP verification')->to($request->email); 
        }); 

        return $code; 
    }); 


    Route::post('/validate-otp', function (Request $request) {
        $code = $request->code; 

        if ($code == auth()->user()->code) {
            auth()->user()->update(['email_verified_at' => now()]); 
            return response(['message' => 'OTP verified'], 200); 
        }


        return response(['message' => 'OTP is wrong.'], 400); 
}); 

    Route::post('/booking-old', function (Request $request) {
        $data = $request->validate([
            'fare' => ['required'],
            'time' => ['required'],
            'date' => ['required'],
            'route_id' => ['required'],
            'qty' => ['required'],
        ]);
        $route = ModelsRoute::find($request->route_id);

        $data['from'] = $route->from->name;
        $data['to'] = $route->to->name;
        $data['seat_numbers'] = 'TDF'; // to be follow
        $data['discount'] = 0;
        $data['user_id'] = auth()->id();
        $data['status'] = 'PAID';

        // add transaction
        Transaction::create([
            'type' => 'PAYMENT',
            'bound' => 'OUT',
            'amount' => $data['fare'] * $data['qty'],
            'user_id' => auth()->id(),
            'status' => 'APPROVED',
        ]);

        $booking = Booking::create($data);

        return [
            'booking' => $booking,
        ];
    });

    Route::post('/resource', function (Request $request) {
        $model = $request->model;
        $method = $request->method;
        $payload = $request->payload;

        $model = "\\App\\Models\\$model";
        if ($payload) {

            return ($model)::$method($payload);
        }
        return ($model)::$method();
    });


    Route::get('/resource', function (Request $request) {
        $model = $request->model;
        $method = $request->method;
        $payload = $request->payload;

        $model = "\\App\\Models\\$model";
        if ($payload) {
            return ($model)::$method($payload);
        }
        return ($model)::$method();
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::post('/upload-receipt', function (Request $request) {
        $data = $request->validate([
            'reference' => 'required',
        ]);

        if ($request->has('booking')) {
            $booking = Booking::find($request->booking);
            Mail::raw("Your receipt has been submitted to the administrator.", function ($message) use($booking) {
                $message->subject('Booking payment')->to($booking->user->email); 
            }); 

            $booking->update(['status' => 'PAYMENT CONFIRMATION']); 
            $users = User::whereType('ADMIN')->get(); 

            foreach($users as $user) {
                Mail::raw("New payment receipt has been received, waiting for your review.", function ($message) use($user) {
                    $message->subject('Booking payment')->to($user->email); 
                }); 
            }
        }
        if ($request->hasFile('file')) {
            $filePath = $request->file->store('public'); 

            $filePathArray = explode('/', $filePath); 
            $data['image'] = end($filePathArray); 
        }

        $data['user_id'] = auth()->id(); 

        return Receipt::create($data); 
    
    });
});

Route::get('/public-test', function () {
    return 'public test';
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::get('/test', function (Request $request) {
    $model = $request->model;
    $method = $request->method;
    $payload = $request->payload;

    $model = "\\App\\Models\\$model";
    if ($payload) {

        return ($model)::$method($payload);
    }
    return ($model)::$method();
});


Route::get('/get-offers', function (Request $request) {
    $query = ['day' => $request->day, 'route_id' => $request->route_id];
    return Schedule::with(['bookings', 'bus', 'route'])->where($query)->get(); 
}); 