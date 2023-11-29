<?php

use App\Models\Booking;
use App\Models\Receipt;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Route as ModelsRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Schedule;

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
        $inTransactions = auth()->user()->transactions()->whereBound('IN')->sum('amount'); 
        $outTransactions = auth()->user()->transactions()->whereBound('OUT')->sum('amount'); 

        $totalBalance = $inTransactions - $outTransactions; 
        
        if ($inTransactions - $outTransactions <= 0) return ['message' => 'no balance']; 

        $schedule = Schedule::find($request->schedule_id);

        $passenger = $request->passenger; 
        
        $fare = $schedule->route->fare + $schedule->bus->additional_fee; 

        $totalCharges = $passenger * $fare; 

        if ($totalCharges > $totalBalance) return ['message' => 'not enough balance']; 

        $booking = Booking::create([
            'status' => 'APPROVED', 
            'from' => $schedule->route->from->name, 
            'to' => $schedule->route->to->name, 
            'fare' => $fare,
            'user_id' => auth()->id(),
            'qty' => $passenger, 
            'date' => $request->date, 
            'seat_number' => 'TBF', 
            'route_id' => $schedule->route_id, 
            'time' => $schedule->departure, 
            'schedule_id' => $schedule->id, 
        ]); 


        // add transaction
        Transaction::create([
            'type' => 'PAYMENT',
            'bound' => 'OUT',
            'amount' => $totalCharges,
            'user_id' => auth()->id(),
            'status' => 'APPROVED',
        ]);

        return ['message' => 'success', 'booking' => $booking]; 
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