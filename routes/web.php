<?php

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\SalesRecord;
use App\Models\PreOrderItem;
use Illuminate\Http\Request;
use App\Models\ProductInventory;
use Illuminate\Support\Facades\DB;
use App\Models\IngredientInventory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
    $nextYear = $years[$lastItem] + 1;
    if ($count == 1) {
        return [
            'c_date' => $nextYear,
            'total' => $values[0],
        ];
    }
    $slope = ($values[$lastItem] - $values[$secLastItem]) / ($years[$lastItem] - $years[$secLastItem]);
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


Route::get("/fp-graphs/{product}", function (Request $request, Product $product) {
    try {
        $o = OrderItem::whereProductId($product->id)
        ->select(DB::raw('DATE_FORMAT(created_at, "%Y") as c_date'), DB::raw('sum(quantity) as total'))
        ->groupBy('c_date')
        ->orderBy('c_date')
        ->get();


    $fo = null;
    if (count($o)) {
        $fo = predict($o->map( fn ($e) => $e->total), $o->map(fn ($e) => $e->c_date));
    }

    if ($fo)  $o->push($fo);

    $po = PreOrderItem::whereProductId($product->id)
        ->select(DB::raw('DATE_FORMAT(created_at, "%Y") as c_date'), DB::raw('sum(quantity) as total'))
        ->groupBy('c_date')
        ->orderBy('c_date')
        ->get();

        $fpo = null;

    if (count($po)) {
        $fpo = predict($po->map( fn ($e) => $e->total), $po->map(fn ($e) => $e->c_date));
    }

    if ($fpo) $po->push($fpo);


    $orderRecords = $o;
    $preOrderRecords = $po;

    return view('f-graphs', compact('preOrderRecords', 'orderRecords', 'product'));
    } catch (Exception $e) {
        return "No enough data";
    }
});

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

Route::get('/sr', function (Request $request) {
    $from = $request->from;
    $to = $request->to;
    $records = SalesRecord::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->get();
    return view("sales-record", compact('records', 'from', 'to'));
});
