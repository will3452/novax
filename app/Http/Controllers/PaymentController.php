<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function createTransaction(Request $request) {
        if ($request->has('bid')) {
            $reference = $request->bid;
            $billing = Billing::findOrFail($reference);
            return view('create-transaction', compact('billing'));
        }
        return redirect()->to('/app/dashboards/');
    }

    public function processTransaction(Request $request) {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $billingId = $request->bid;
        $billing = Billing::findOrFail($billingId);

        $response =  $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "PHP",
                        "value" => number_format($billing->amount, 2, '.', ''),
                    ]
                ]
            ]
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        $queryString = parse_url($links['href'], PHP_URL_QUERY);
                        $params = [];
                        parse_str($queryString, $params);
                        $billing->update(['token' => $params['token']]);
                        return redirect()->away($links['href']);
                    }
                }

                return redirect()
                    ->route('createTransaction')
                    ->with('error', 'Something went wrong.');
            } else {
                return redirect()
                    ->route('createTransaction')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
    }

    public function successTransaction(Request $request) {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $token = $request->token;
        $response = $provider->capturePaymentOrder($token);
        $billing = Billing::whereToken($token)->firstOrFail();

        if (isset($response['status']) && $response['status'] == "COMPLETED") {
            $billing->payments()->create([
                'amount' => $billing->amount,
            ]);
            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction Complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function cancelTransaction(Request $request) {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
