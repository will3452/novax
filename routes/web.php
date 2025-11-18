<?php

use App\Models\OrderItem;
use App\Models\Prediction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Phpml\Regression\LeastSquares;

Route::get('predict', function (Request $request) {
    $period = $request->input('period', 'day');
    $product_id = $request->input('product_id', 5);
    $product = Product::find($product_id);
    $predict_intervals = $request->input('predict_intervals', 1);

    // group by product_id and period: day, week, month, year and include total qty sold
    $sales = OrderItem::selectRaw("SUM(qty) as total_qty,
        CASE
            WHEN '$period' = 'day' THEN DATE(created_at)
            WHEN '$period' = 'week' THEN YEARWEEK(created_at)
            WHEN '$period' = 'month' THEN DATE_FORMAT(created_at, '%Y-%m')
            WHEN '$period' = 'year' THEN YEAR(created_at)
        END as period")
        ->where('product_id', $product_id)
        ->groupBy('period')
        ->orderBy('period')
        ->get();

    $start = $sales->first()->period;
    $end = $sales->last()->period;
    $intervals = [];
    if ($period == 'day') {
        $current = \Carbon\Carbon::parse($start);
        $endDate = \Carbon\Carbon::parse($end);
        while ($current->lte($endDate)) {
            $intervals[] = $current->toDateString();
            $current->addDay();
        }
        // add interval after end date base on the predict_intervals
        for ($i = 0; $i < $predict_intervals; $i++) {
            $intervals[] = $current->toDateString();
            $current->addDay();
        }
    } elseif ($period == 'week') {
        $current = \Carbon\Carbon::now()->setISODate(substr($start, 0,4), substr($start, 4,2));
        $endDate = \Carbon\Carbon::now()->setISODate(substr($end, 0,4), substr($end, 4,2));
        while ($current->lte($endDate)) {
            $intervals[] = $current->format('oW');
            $current->addWeek();
        }
        // add interval after end date base on the predict_intervals
        for ($i = 0; $i < $predict_intervals; $i++) {
            $intervals[] = $current->format('oW');
            $current->addWeek();
        }
    } elseif ($period == 'month') {
        $current = \Carbon\Carbon::parse($start . '-01');
        $endDate = \Carbon\Carbon::parse($end . '-01');
        while ($current->lte($endDate)) {
            $intervals[] = $current->format('Y-m');
            $current->addMonth();
        }
        // add interval after end date base on the predict_intervals
        for ($i = 0; $i < $predict_intervals; $i++) {
            $intervals[] = $current->format('Y-m');
            $current->addMonth();
        }
    } elseif ($period == 'year') {
        $current = \Carbon\Carbon::createFromDate($start);
        $endDate = \Carbon\Carbon::createFromDate($end);
        while ($current->lte($endDate)) {
            $intervals[] = $current->format('Y');
            $current->addYear();
        }
        // add interval after end date base on the predict_intervals
        for ($i = 0; $i < $predict_intervals; $i++) {
            $intervals[] = $current->format('Y');
            $current->addYear();
        }
    }

    // Prepare data for training
    $_period = [];
    $_orders = [];
    $index = 1;
    for ($i = 0; $i < $sales->count(); $i++) {
        $_period[] = $index++;
        $_orders[] = $sales[$i]->total_qty ?? 0;
    }

    $samples = array_map(fn($d) => [$d], $_period);

    $regression = new LeastSquares();
    $regression->train($samples, $_orders);
    $prediction = $regression->predict([$index]);

    $results = \App\Models\Prediction::updateOrCreate(
        [   'product_id' => $product_id,
            'prediction_for' => $intervals[$sales->count()-1],
            'interval' => $period],
        [
            'prediction_for' => $intervals[$sales->count()-1],
            'interval' => $period,
            'sales_quantity' => $prediction,
            'stock_recommendation' => max(0, ($prediction - $product->default_stock)),
            'product_id' => $product_id,
        ]
    );

    return $results;
});

Route::get('/', function () {
    return redirect()->to(config('nova.path'));
});


//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});


Route::get('/verification-notice', function () {
    return view('auth.verify-notice');
})->name('verification.notice');

Route::post('/verification-send', function () {
    $user = auth()->user();
    // Logic to send verification code to the user
    // For example, create a verification code and email it to the user
    $code = rand(100000, 999999);
    \App\Models\VerificationCode::create([
        'user_id' => $user->id,
        'code' => $code,
        'expires_at' => now()->addMinutes(15),
    ]);
    // Here you would typically send the code via email

    return back()->with('status', 'Verification code sent!');
})->name('verification.send');

Route::post('/verification-verify', function () {
    $user = auth()->user();
    $inputCode = request()->verification_code;

    $verificationCode = \App\Models\VerificationCode::where('user_id', $user->id)
        ->where('code', $inputCode)
        ->where('expires_at', '>', now())
        ->first();

    if ($verificationCode) {
        // Mark user as verified
        $user->verified_at = now();
        $user->save();

        // Optionally, delete used verification codes
        \App\Models\VerificationCode::where('user_id', $user->id)->delete();

        return redirect()->intended('/')->with('status', 'Your account has been verified!');
    } else {
        return back()->withErrors(['code' => 'Invalid or expired verification code.']);
    }
})->name('verification.verify');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');
