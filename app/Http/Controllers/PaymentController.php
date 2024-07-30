<?php

namespace App\Http\Controllers;

use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getClient () {
        $API_URL = nova_get_setting('payment_api_base_url', 'https://api.sandbox.innovative-minds.ph');
        $client = new Client([
            'base_uri' => $API_URL, 
        ]);  
        return $client; 
    }
    public function authenticate() {
        $client = $this->getClient(); 
        $credentials = [
            'username' => nova_get_setting('payment_credential_username', 'luckybet_uat'),
            'secret' => nova_get_setting('payment_credential_secret', 'xf-4o@((*6dvb4m=i&g&d1yopttro2^(fgkfbo73w$+u=pk&5z'),
            'app_uuid' => nova_get_setting('payment_credential_app_uuid', 'aadc584a-6bad-4e05-9bcd-a25b6bef984b'), 
        ]; 


        $response = $client->request('POST', '/api/v1/auth/obtain-token/', [
            'headers' => [
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
            ],
            'body' => json_encode($credentials)
        ]);

        return $response->getBody()->getContents(); 
    }

    public function generateQR(Request $request, $reference, $amount) {
        $auth = $this->authenticate(); 
        $token = json_decode($auth)->data->token; 

        $client = $this->getClient(); 

        $body = [
            'app_uuid' => nova_get_setting('payment_credential_app_uuid', 'aadc584a-6bad-4e05-9bcd-a25b6bef984b'), 
            'endpoint' => 'p2m-generateQR', 
            'callback_uri' => nova_get_setting('payment_callback_uri', 'https://webhook.site/263c413d-3ff9-4730-aa63-856045efd2a0'),
            'reference_number' => $reference,
            'merchant_details' => [
                'txn_type' => 0,
                'method' => 'dynamic',
                'txn_amount' => $amount, 
                'scanner_mobile_number' => '639182821438', // to be ask 
            ],
            'other_details' => null, 
        ]; 

        $response = $client->request('POST','/api/v1/payments/qr-codes/generate/',[
            'headers' => [
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
                'Authorization' => "Bearer $token", 
            ],
            'body' => json_encode($body)
        ]); 

        return $response->getBody()->getContents(); 
    }

    public function checkout (Request $request) {
        // create order
        $total_amount = 0;
        foreach ($request->line_items as $item) {
            $total_amount += ($item['amount'] / 100) * $item['quantity'];
        }

        $reference = "REF" . Str::random(16); 

        $order = Order::create([
            'customer_id' => auth()->id(),
            'reference' => $reference,
            'payment_method' => "ONLINE",
            'payment_status' => "PENDING",
            'total_amount' => $total_amount,
        ]);

        foreach ($request->line_items as $item) {
            $product = Product::find($item["product_id"]);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item["product_id"],
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'payment_method' => "ONLINE",
                'payment_status' => "PENDING",
            ]);
        }

        return $this->generateQR($request, $reference, $total_amount); 
    }
}
