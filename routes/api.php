<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;
use App\Mail\AppointmentReminder;
use App\Models\Appointment;
use App\Models\BotResponse;
use App\Models\CronJob;
use App\Models\Endpoint;
use App\Models\SlotCount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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


Route::get('/get-message', function (Request $request) {
    $message = [
        'id' => Carbon::now(),
        'from' => 'bot',
        'message' => "Hello! I am Joy, I’m here to assist you with any questions or information you might need. Just choose and click your desired  question below. ",
        'questions' => BotResponse::whereNull('parent_id')->get()->pluck('question'),
    ];

    if ($request->has('q')) {
        $q = $request->q;
        if ($q == 'SHOW_CATEGORIES') {
            $categories = BotResponse::select('category')->distinct()->get()->pluck('category');
            $m = "These are the categories of questions I can help with. <br /> ";
            foreach ($categories as $c) {
                $m .= "<b> - $c</b> <br />";
            }
            $m .= "<br /> <br /> To choose a category, <br /> use this format: <b> 'show category &lt;category&gt;' </b>";
            $message['message'] = $m;
            return $message;
        }

        if (strpos($q, "show category ") !== false) {
            $stmt = explode("show category ", $q);
            $category = end($stmt);
            $message['message'] = $category;
            $questions = BotResponse::whereCategory($category)->get();
            $m = "These are the questions under $category <br /> ";
            foreach ($questions as $c) {
                $m .= "<b> - $c->question </b> <br />";
            }
            $message['message'] = $m;
            return $message;
        }
        $response = BotResponse::whereQuestion($q)->first();
        if (! $response ) {
            $message['message'] = "I'm sorry, I don't have the information you're looking for right now. 🤔But don't worry! You can visit our <a style='color:white' href='/faq'>FAQ page</a> where you might find the answer you're looking for. If you still need assistance, feel free to reach out to our team directly!";
            return $message;
        }

        $message['message'] = $response->answer;
        $message['questions'] = BotResponse::whereParentId($response->id)->get()->pluck('question');
    }

    return $message;
});


Route::get('/fully-booked', function () {
    return SlotCount::where('count', '>=', 21)->get()->pluck('date');
});

Route::get('/slots', function (Request $request) {
    $date = $request->date;
    $exists = Appointment::whereDate('date', $date)->get()->pluck('slot')->toArray();
    $slots = \App\Models\Appointment::getSlots();
    $available = [];
    foreach ($slots as $key => $value) {
        if (! in_array($value, $exists)) {
            array_push($available, $value);
        }
    }

    return $available;
});


Route::get('/reminders', function () {
    $app = Appointment::whereDate('date', today()->addDay(2))->get();
    $app->load('patient');
    foreach ($app as $a) {
        Mail::to($a->patient->email)->send(new AppointmentReminder($a));
    }

    return 'ok!';
});
