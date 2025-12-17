<?php

use App\Models\Barangay;
use App\Models\DocumentRequest;
use App\Models\Profile;
use App\Models\BarangayDocument;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthenticationController;
use App\Models\CronJob;
use App\Models\Endpoint;

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
Route::middleware("auth:sanctum")->group(function () {
    Route::post("/logout", [ApiAuthenticationController::class, "logout"]);

    Route::get("/activities", function () {
        $limit = request()->query("limit", 5);
        $response = Cache::remember(
            "activities-" . auth()->id() . "-" . $limit,
            now()->addMinutes(1),
            function () use ($limit) {
                return \Spatie\Activitylog\Models\Activity::whereCauserId(
                    auth()->id(),
                )
                    ->latest()
                    ->take($limit)
                    ->get();
            },
        );
        return response()->json($response);
    });

    Route::get("/barangay-docs/{barangayId}", function ($barangayId) {
        $bd = BarangayDocument::whereBarangayId($barangayId)->get();
        $bd->load(["document", "barangay"]);
        return response()->json($bd);
    });

    Route::get("/request-docs", function (Request $request) {
        $user = auth()->user();
        $filter = $request->query("filter");
        $limit = $request->query("limit", 5);
        $barangayId = $request->query("barangay");

        return Cache::remember(
            "request-docs-$user->id**$filter**$limit**$barangayId",
            now()->addMinutes(1),
            function () use ($user, $filter, $limit, $barangayId) {
                $dRequests = DocumentRequest::whereUserId($user->id)
                    ->where("status", "LIKE", "%$filter%")
                    ->whereBarangayId($barangayId)
                    ->orderBy("created_at", "desc")
                    ->take($limit)
                    ->get();
                $dRequests->load(["document"]);
                return $dRequests;
            },
        );
    });

    Route::post("/request-doc", function (Request $request) {
        $user = auth()->user();
        $ref = BarangayDocument::whereBarangayId($request->barangay_id)
            ->whereDocumentId($request->document_id)
            ->first();

        $dRequest = DocumentRequest::create([
            "reference_number" => Str::random(12),
            "user_id" => $user->id,
            "document_id" => $ref->document_id,
            "status" => "pending",
            "purpose" => $request->purpose ?? null,
            "barangay_id" => $ref->barangay_id,
            "fee" => $ref->fee,
            "processing_period" => $ref->processing_period,
        ]);

        activity()
            ->performedOn($dRequest)
            ->causedBy($user)
            ->withProperties(["icon" => "lucide:send"])
            ->log("You requested a document.");

        return response()->json(
            [
                "message" => "Document request received",
                "data" => $dRequest,
            ],
            201,
        );
    });

    Route::post("/events/join", function (Request $request) {
        $user = auth()->user();
        $event = \App\Models\BarangayEvent::find($request->event_id);
        $data = $user->events()->toggle($event->id);
        $action = $data["attached"] ? "joined" : "unjoined";
        activity()
            ->performedOn($event)
            ->causedBy($user)
            ->withProperties(["icon" => "lucide:calendar-sync"])
            ->log("You $action an event.");

        return response()->json(
            [
                "message" => "Event joined",
                "data" => $data,
            ],
            200,
        );
    });
    Route::get("/events", function (Request $request) {
        $barangayId = $request->barangay;
        $events = Cache::remember(
            "events-$barangayId",
            now()->addMinutes(2),
            function () use ($barangayId) {
                return \App\Models\BarangayEvent::with("attendees")
                    ->whereBarangayId($barangayId)
                    ->whereDate("date", ">", now())
                    ->get();
            },
        );

        $ongoing = Cache::remember(
            "ongoing-events-$barangayId",
            now()->addMinutes(2),
            function () use ($barangayId) {
                return \App\Models\BarangayEvent::with("attendees")
                    ->whereBarangayId($barangayId)
                    ->whereDate("date", now())
                    ->get();
            },
        );

        $all = Cache::remember(
            "all-events-$barangayId",
            now()->addMinutes(2),
            function () use ($barangayId) {
                return \App\Models\BarangayEvent::with("attendees")
                    ->whereBarangayId($barangayId)
                    ->get();
            },
        );

        return response()->json(
            [
                "message" => "Events retrieved",
                "data" => $events,
                "all" => $all,
                "ongoing" => $ongoing,
            ],
            200,
        );
    });
});

Route::get("/public-test", function () {
    return "public test";
});

//user authentication
Route::post("/register", [ApiAuthenticationController::class, "register"]);
Route::post("/login", [ApiAuthenticationController::class, "login"]);

Route::any("/cron", function (Request $request) {
    CronJob::create([]);
});

Route::any("/v1/{params}", function (Request $request, $params) {
    $method = Str::lower($request->getMethod());
    $path = $request->getPathInfo();
    $arr_path = explode("/", $path);
    $name = end($arr_path);
    $endpoint = Endpoint::whereMethod($method)->wherePath($name)->first();
    return [
        "params" => $endpoint,
        "method" => Str::lower($request->getMethod()),
    ];
});

Route::get("/barangays", function () {
    return Cache::remember("barangays", now()->addMinutes(5), function () {
        return Barangay::get();
    });
});

Route::get("suffixes", function () {
    return Cache::remember("suffixes", now()->addMinutes(5), function () {
        return Profile::SUFFIX;
    });
});

Route::get("/logo", function () {
    return nova_get_setting("logo");
});
