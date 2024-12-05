<?php

use App\Models\IngredientInventory;
use App\Models\ProductInventory;
use App\Models\SalesRecord;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect()->to(config('nova.path'));
});


Route::get('/i-graphs', function () {
    $dailyUsage = IngredientInventory::whereType('USAGE')->select('ingredient_id', DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as c_date'), DB::raw('sum(quantity) as total'))->groupBy('ingredient_id', 'c_date')->get();
    $monthlyUsage = IngredientInventory::whereType('USAGE')->select('ingredient_id', DB::raw('DATE_FORMAT(created_at, "%Y-%m") as c_date'), DB::raw('sum(quantity) as total'))->groupBy('ingredient_id', 'c_date')->get();
    $yearlyUsage = IngredientInventory::whereType('USAGE')->select('ingredient_id', DB::raw('DATE_FORMAT(created_at, "%Y") as c_date'), DB::raw('sum(quantity) as total'))->groupBy('ingredient_id', 'c_date')->get();
    return view('i-graphs', compact('monthlyUsage', 'dailyUsage', 'yearlyUsage'));
});

Route::get('/p-graphs', function () {
    $dailyUsage = ProductInventory::whereType('ORDER')->select('product_id', DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as c_date'), DB::raw('sum(quantity) as total'))->groupBy('product_id', 'c_date')->get();
    $monthlyUsage = ProductInventory::whereType('ORDER')->select('product_id', DB::raw('DATE_FORMAT(created_at, "%Y-%m") as c_date'), DB::raw('sum(quantity) as total'))->groupBy('product_id', 'c_date')->get();
    $yearlyUsage = ProductInventory::whereType('ORDER')->select('product_id', DB::raw('DATE_FORMAT(created_at, "%Y") as c_date'), DB::raw('sum(quantity) as total'))->groupBy('product_id', 'c_date')->get();
    return view('p-graphs', compact('monthlyUsage', 'dailyUsage', 'yearlyUsage'));
});

//artisan helper
Route::get('/artisan', function () {
    $result = Artisan::call(request()->param);
    return $result;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

function predict ($values, $years) {
    $count = count($values);
    $lastItem = $count - 1;
    $secLastItem = $count - 2;
    $slope = ($values[$lastItem] - $values[$secLastItem]) / ($years[$lastItem] - $years[$secLastItem]);
    $nextYear = $years[$lastItem] + 1;
    $item = [
        'c_date' => $nextYear,
        'total' => $values[$lastItem] + ($nextYear - $years[$lastItem]) * $slope,
    ];
    return $item;
}

// function predict($records, $horizon, $cls) {
//     try {
//             $response = Http::withHeaders([
//                 'Content-Type' => 'application/json',
//                 'x-rapidapi-host' => 'predict7.p.rapidapi.com',
//                 'x-rapidapi-key' => '4d9f335661msh605a69a811a4957p12be14jsnc2025c1b9b8d',
//             ])
//                 ->post('https://predict7.p.rapidapi.com/', [
//                     'data' => $records,
//                     'horizon' => $horizon ?? 1,
//                     'cls' => [1.0, 0.5, 0.3],
//                 ]);

//         dd($response->json());

//         if ($response->successful()) {
//             $data = $response->json(); // Get the response as an array
//             return $data;
//         } else {
//             throw new Exception("error");
//         }

//         return $data;
//     } catch (Exception $e) {
//         return [];
//     }
// }
Route::get('/f-graphs', function (Request $request) {
    $preOrderRecords = SalesRecord::whereSource('PRE-ORDER')
        ->select(DB::raw('DATE_FORMAT(created_at, "%Y") as c_date'), DB::raw('sum(total) as total'))
        ->groupBy('c_date')
        ->orderBy('c_date')
        ->get();

        $popRecords = predict($preOrderRecords->map( fn ($e) => $e->total), $preOrderRecords->map(fn ($e) => $e->c_date));

        $preOrderRecords->push($popRecords);

    $orderRecords = SalesRecord::whereSource('ORDER')
        ->select(DB::raw('DATE_FORMAT(created_at, "%Y") as c_date'), DB::raw('sum(total) as total'))
        ->groupBy('c_date')
        ->orderBy('c_date')
        ->get();

    $popRecords = predict($orderRecords->map( fn ($e) => $e->total), $orderRecords->map(fn ($e) => $e->c_date));

    $orderRecords->push($popRecords);

    return view('f-graphs', compact('preOrderRecords', 'orderRecords'));
});
