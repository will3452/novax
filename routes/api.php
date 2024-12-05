<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PreOrder;
use App\Models\PreOrderItem;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::post('/predict', function (Request $request) {

    $records = $request->data;
    $horizon = $request->horizon;
    $cls = $request->cls;

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'x-rapidapi-host' => 'predict7.p.rapidapi.com',
        'x-rapidapi-key' => '1b247d396amsh8e8a6460feee0a1p1f870cjsn6124f6f929aa',
    ])
        ->post('https://predict7.p.rapidapi.com/', [
            'data' => $records,
            'horizon' => $cls ?? 1,
            'cls' => $cls ?? [1],
        ]);

    if ($response->successful()) {
        $data = $response->json(); // Get the response as an array
        dd($data); // Dump and die the response
    } else {
        dd('Request failed');
    }
});


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

Route::get('/products', function(Request $request) {
    return Product::get();
});


Route::get('migrate', function () {
    $orders = Order::get();
    $success = 0;
    foreach ($orders as $o) {
        OrderItem::create([
            'product_id' => $o->product_id,
            'order_id' => $o->id,
            'quantity' => $o->quantity,
        ]);
        $success++;
    }
    $total = count($orders);
    return "$success / $total";
});

Route::post('/pre-order', function (Request $request) {
    $request->validate([
        'pickup_date' => ['required', 'date'],
        'customer' => ['required'],
        'products' => ['required'],
    ]);

    $preOrderData = [
        'pickup_date' => $request->pickup_date,
        'customer' => $request->customer,
        'reference' => now()->timestamp,
        'status' => 'For Confirmation',
        'payable' => 0,
    ];

    $items = [];


    foreach ($request->products as $i) {
        $item = [];
        $product = Product::find($i['product']);
        $item['payable'] = $product->price * $i['qty'];
        $item['product_id'] = $product->id;
        $item['price'] = $product->price;
        $item['quantity'] = $i['qty'];
        array_push($items, $item);
        $preOrderData['payable'] += $item['payable'];
    }

    $preOrder = PreOrder::create($preOrderData);

    foreach ($items as $item) {
        $item['pre_order_id'] = $preOrder->id;
        PreOrderItem::create($item);
    }

    $preOrder->load('items');

    return $preOrder;
});


Route::get('/promos', function () {
    return Promo::where(['is_active' => true])->get();
});

Route::get('/p-sync', function () {
    $ps = Product::get();
    foreach ($ps as $p) {
        $adj = $p->inventories()->whereType('ADJUSTMENT')->sum('quantity');
        $orders = $p->inventories()->whereType('ORDER')->sum('quantity');
        $p->update(['ci' => $adj - $orders]);

        // qty sell
        $p->update(['qty_sell' => $orders]);
    }
});

Route::get('/i-sync', function () {
    $ingredients = Ingredient::get();
    foreach ($ingredients as $i) {
        $totalUsage = $i->inventories()->whereType('USAGE')->sum('quantity');
        $totalPurchase = $i->inventories()->whereType('PURCHASE')->sum('quantity');
        $current_qty = $totalPurchase - $totalUsage;
        $tp = $i->purchaseOrders()->sum('quantity');
        $opo = $tp - $current_qty;
        $td = $i->inventories()->whereType('USAGE')->avg('quantity') ?? 0;
        $dl = 0;
        if ($td != 0) {
            $dl = number_format($current_qty / $td, 2);
        }
        $i->update([
            'current_qty' => $current_qty,
            'opo' => $opo,
            'tp' => $tp,
            'tu' => $totalUsage,
            'td' => $td,
            'dl' => $dl,
        ]);
    }

    return 'success!';
});
