<?php

use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Product;
use App\Models\ChangeLog;
use App\Models\OrderItem;
use App\Models\WebhookLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreCategoryController;
use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\URL;

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
    Route::get('/session', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    Route::post('/secure-purchase', function(Request $request) {
        return URL::temporarySignedRoute('sp', now()->addMinutes(nova_get_setting('sec_age', 3)), $request->all());
    });


    // payments
    // Route::post('/checkout-session', function (Request $request) {
    //     // create order
    //     $total_amount = 0;
    //     foreach ($request->line_items as $item) {
    //         $total_amount += ($item['amount'] / 100) * $item['quantity'];
    //     }

    //     $order = Order::create([
    //         'customer_id' => auth()->id(),
    //         'reference' => "REF" . Str::random(16),
    //         'payment_method' => "ONLINE",
    //         'payment_status' => "PENDING",
    //         'total_amount' => $total_amount,
    //     ]);

    //     foreach ($request->line_items as $item) {
    //         $product = Product::find($item["product_id"]);
    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'product_id' => $item["product_id"],
    //             'quantity' => $item['quantity'],
    //             'unit_price' => $product->price,
    //             'payment_method' => "ONLINE",
    //             'payment_status' => "PENDING",
    //         ]);
    //     }

    //     $client = new Client();
    //     $auth = base64_encode(nova_get_setting('secret_key'));
    //     $line_items = $request->line_items;
    //     $body = [
    //         'data' => [
    //             'attributes' => [
    //                 'send_email_receipt' => false,
    //                 'show_description' => true,
    //                 'show_line_items' => true,
    //                 'line_items' => $line_items,
    //                 "payment_method_types" => ["gcash", "grab_pay", "card"],
    //                 "description" => "Chizmis Store payment orders",
    //                 "success_url" => nova_get_setting('success_url'),
    //                 "reference_number" => $order->reference,
    //             ]
    //         ],
    //     ];
    //     $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
    //         'body' => json_encode($body),
    //         'headers' => [
    //             'Content-Type' => 'application/json',
    //             'accept' => 'application/json',
    //             'authorization' => "Basic $auth",
    //         ],
    //     ]);


    //     return $response->getBody();
    // });

    Route::post('/checkout-session', [PaymentController::class, 'checkout']);

    Route::post('/checkout-qr', [PaymentController::class, 'generateQR']);

    // carts
    Route::prefix('cart-items')->group(function () {
        Route::get('/', [CartController::class, 'getItems']);
        Route::post('/', [CartController::class, 'addItem']);
        Route::delete('/{cartItem}', [CartController::class, 'removeItem']);
        Route::put('/{cartItem}', [CartController::class, 'updateItem']);
    });

});


Route::get('/checkout-qr', [PaymentController::class, 'generateQR']);


Route::get('/secure-purchase', function (Request $request) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }

    return view('secure_page');
})->name('sp');


//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);

Route::resource('products', ProductController::class);
Route::resource('stores', StoreController::class);
Route::resource('store-categories', StoreCategoryController::class);

Route::get('change-logs', function (Request $request) {
    return ChangeLog::latest()->get();
});

// webhook
Route::post('/payment', function (Request $request) {
    $data = $request->data;
    WebhookLog::create([
        'payload' => json_encode($request->data),
    ]);

    $reference = $data->attributes->data->attributes->reference_number;
    WebhookLog::create([
        'payload' => json_encode(['reference' => $reference]),
    ]);
    if ($data->attributes->type == "checkout_session.payment.paid") {
        WebhookLog::create([
            'payload' => json_encode(['$data->attributes->type' => $data->attributes->type]),
        ]);
        Order::whereReference($reference)->update(['payment_status' => 'PAID']);
    }

    return [
        'message' => 'ok'
    ];
});
