<?php

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\Group;
use App\Models\CronJob;
use App\Models\Endpoint;
use App\Models\UserLoan;
use App\Models\SmsCredit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentSchedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Capital;
use Laravel\Nova\Actions\Action;

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

        $limit = nova_get_setting('sms_limit', 100);
        $credits = SmsCredit::count() - $limit;

        if ($credits < count($result)) return 'No Balance';

        foreach ($result as $r) {
            (new SmsCredit())->save();
        }

        $ch = curl_init();
        $parameters = array(
            'apikey' => nova_get_setting('sms_key', env('SMS_KEY')),
            'number' => implode(",", $result),
            'message' => nova_get_setting('sms_template', 'juantap: reminders please settle your loan.'),
            'sendername' => 'OTIEPI'
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages');
        curl_setopt( $ch, CURLOPT_POST, 1);

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);
    }
    return $result;
})->name('cron');

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

Route::post('/loan', function (Request $request) {
    $data = json_decode($request->data);
    $data->type = strtoupper($data->type);
    $data->reference = "L" . Str::random(8);


    $capital = Capital::sum('amount') - Loan::whereStatus('PENDING')->sum('amount');

    // validation
    if (($data->amount >= $capital)) {
        return response(['error' => 'Your available capital is insufficient to proceed with this operation.'], 401);
    }
    if ($data->amount < nova_get_setting('minimum_loan')) {
        return response(['error' => 'The loan amount does not meet the minimum required threshold.'], 401);
    }

    if ($data->amount > nova_get_setting('max_loan')) {
        return response(['error' => 'The loan amount exceeds the maximum permitted threshold.'], 401);
    }

    $data->start_date = now()->addDay(1);

    $data->end_date = now()->addDay($data->number_of_installment);

    if ($data->payment_schedule == "WEEKLY") {
        $data->start_date = now()->addWeek(1);
        $data->end_date = now()->addWeek($data->number_of_installment);
    }


    if ($data->payment_schedule == "MONTHLY") {
        $data->start_date = now()->addMonth(1);
        $data->end_date = now()->addMonth($data->number_of_installment);
    }


    $collateral = $request->collateral->store('public');
    $cr = explode('/', $collateral);
    $data->collateral_image = end($cr);
    $agreement = $request->agreement->store('public');
    $ar = explode('/', $agreement);
    $data->agreement_image = end($ar);
    $loan = Loan::create(get_object_vars($data));


    if ($data->type == 'INDIVIDUAL') {
        UserLoan::create([
            'loan_id' => $loan->id,
            'user_id' => $data->user_id,
        ]);
    } else {
        $group = Group::find($data->group_id);
        // dd($group->groupMembers);
        foreach ($group->groupMembers as $m) {

            UserLoan::create([
                'loan_id' => $loan->id,
                'user_id' => $m->id,
                'group_id' => $group->id,
            ]);
        }
    }
    return $loan;
});
