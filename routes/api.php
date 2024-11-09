<?php

use Carbon\Carbon;
use App\Models\CronJob;
use App\Models\Endpoint;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentSchedule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;
use Illuminate\Database\Eloquent\Collection;

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
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::any('/cron', function (Request $request) {
    CronJob::create([]);
    $result = [];
    if (nova_get_setting('reminder', false)) {
        $dueToday = PaymentSchedule::whereDate('due_date', Carbon::today())->get();
        $dueToday->load('loan.users');
        $borrowers = collect();

        foreach($dueToday as $due) {
            foreach($due->loan->users as $b) {
                $borrowers->add($b->phone);
            }
        }
        $result = $borrowers->unique()->values()->all();

        $ch = curl_init();
        $parameters = array(
            'apikey' => nova_get_setting('sms_key', env('SMS_KEY')),
            'number' => implode(",", $result),
            'message' => nova_get_setting('sms_template', 'juantap: reminders please settle your loan.'),
            'sendername' => 'OTIEPI'
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
    return $result;
});

Route::any('/v1/{params}', function (Request $request, $params) {
    $method = Str::lower($request->getMethod());
    $path = $request->getPathInfo();
    $arr_path = explode("/", $path);
    $name = end($arr_path);
    $endpoint = Endpoint::whereMethod($method)->wherePath($name)->first();
    return [
        'params' => $endpoint,
        'method' => Str::lower($request->getMethod()),
    ];
});
