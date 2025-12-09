<?php

use App\Models\Barangay;
use App\Models\DocumentRequest;
use App\Models\Profile;
use App\Models\BarangayDocument;
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
    Route::get("/auth-test", function () {
        return "authentication test";
    });
    Route::post("/logout", [ApiAuthenticationController::class, "logout"]);

    Route::get("/barangay-docs/{barangayId}", function ($barangayId) {
        $bd = BarangayDocument::whereBarangayId($barangayId)->get();
        $bd->load(["document", "barangay"]);
        return $bd;
    });

    Route::get("/request-docs", function (Request $request) {
        $user = auth()->user();
        $dRequests = DocumentRequest::whereUserId($user->id)
            ->orderBy("created_at", "desc")
            ->get();
        $dRequests->load(["document"]);
        return $dRequests;
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

        return response()->json(
            [
                "message" => "Document request received",
                "data" => $dRequest,
            ],
            201,
        );
    });

    Route::get("/events", function (Request $request) {
        $barangayId = $request->barangay;
        $events = \App\Models\BarangayEvent::whereBarangayId($barangayId)
            ->whereDate("date", ">", now())
            ->get();

        $ongoing = \App\Models\BarangayEvent::whereBarangayId($barangayId)
            ->whereDate("date", now())
            ->get();

        return response()->json(
            [
                "message" => "Events retrieved",
                "data" => $events,
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
    return Barangay::get();
});

Route::get("suffixes", function () {
    return Profile::SUFFIX;
});

Route::get("/logo", function () {
    return nova_get_setting("logo");
});
