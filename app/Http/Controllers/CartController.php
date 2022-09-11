<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function toggleCart ($productId, $qty, $method = 'POST') {
        $cartItem = CartItem::where('product_id', $productId)->where('user_id', auth()->id())->exists();
        if ($cartItem && $method == 'POST') {
            return CartItem::where('product_id', $productId)->where('user_id', auth()->id())->delete();
        }

        $data = [
            'user_id' => auth()->id(),
            'quantity' => $qty,
            'product_id' => $productId,
        ];

        if ($method == "POST")
            return CartItem::create($data);

        return CartItem::where('product_id', $productId)->where('user_id', auth()->id())->update($data);
    }

    public function addToCart (Request $request, $id) {
        $this->toggleCart($id, $request->quantity);
        return back();
    }

    public function removeToCart(Request $request, $id) {
        $this->toggleCart($id, $request->quantity);
        return back();
    }

    public function index () {
        $items = auth()->user()->cartItems;
        return view('cart', compact('items'));
    }

    public function updateCart (Request $request, CartItem $item) {
        $item->update(['quantity' => $request->quantity]);
        return back()->withSuccess('Done!');
    }

    public function processToGcash($order) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://g.payx.ph/payment_request',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'x-public-key' => env('GETPAID_GCASH_PKEY', 'pk_0bb2b3dc69995ca960daa40a5f1b759d'),
            'amount' => $order->amount_payable,
            'description' => 'Payment for order.',
            'customername' => auth()->user()->name,
            'redirectsuccessurl' => url('/'),
            'webhooksuccessurl' => url('/api/gcash-payment-success'),
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $requestId = json_decode($response)->data->request_id;

        $order->setHash($requestId);
        return $response;

    }

    public function checkout (Request $request) {

        try {
            $products = [];


        foreach (auth()->user()->cartItems as $item) {
            $products[] = [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'product_name' => $item->product->name,
            ];

            $item->delete();
        }

        //create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'products' => json_encode($products),
            'amount_payable' => auth()->user()->subTotal(true),
        ]);

        // checkout with gcash
        $result = $this->processToGcash($order);
        return redirect(json_decode($result)->data->checkouturl);
        } catch (Exception $error) {
            return "ERROR >> " . $error->getMessage();
        }
    }
}
