<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/register", [RegisterController::class, "registrationPage"]);
Route::post("/register", [RegisterController::class, "postRegister"]);

//artisan helper
Route::get("/artisan", function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Route::post("/login", function (Request $request) {
    $request->validate([
        "email" => "required|email",
        "password" => "required|min:8",
    ]);

    $user = \App\Models\User::whereEmail($request->email)->first();

    if ($user && $user->login_attempt >= 3) {
        return redirect()
            ->back()
            ->withErrors([
                "email" =>
                    "You have exceeded the maximum login attempts. Your account has been locked. please contact admin to unlock your account.",
            ]);
    }

    if (
        Auth::attempt([
            "email" => $request->email,
            "password" => $request->password,
        ])
    ) {
        $user->update(["login_attempt", 0]);
        return redirect("/app/dashboards/main");
    }

    if ($user) {
        $user->increment("login_attempt");
    }

    return redirect()
        ->back()
        ->withErrors(["email" => "Invalid credentials"]);
})->name("nova.login");

Route::get("/login", function () {
    return redirect()->to("/app/login");
})->name("nova.login");

Route::get("/create-transaction", [
    PaymentController::class,
    "createTransaction",
])->name("createTransaction");
Route::get("/process-transaction", [
    PaymentController::class,
    "processTransaction",
])->name("processTransaction");
Route::get("/success-transaction", [
    PaymentController::class,
    "successTransaction",
])->name("successTransaction");
Route::get("/cancel-transaction", [
    PaymentController::class,
    "cancelTransaction",
])->name("cancelTransaction");
