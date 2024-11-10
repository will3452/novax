<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Models\Ingredient;
use App\Models\IngredientInventory;
use App\Models\PreOrder;
use App\Models\PreOrderItem;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $dl = $current_qty / $td;
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
