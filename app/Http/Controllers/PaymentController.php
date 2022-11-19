<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request) {
        $curl = curl_init();
        $webhook = url(config('payment.gcash_webhook'));

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
                'x-public-key' => config('payment.gcash_pkey'),
                'amount' => $request->amount,
                'description' => $request->description,
                'customeremail' => $request->customeremail,
                'customermobile' => $request->customermobile,
                'customername' => $request->customername,
                // 'redirectsuccessurl' => $request->redirectsuccessurl,
                'webhooksuccessurl' => $webhook,
                'webhookfailurl' => $webhook,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function choosePay(Request $request, Booking $booking) {
        return view('payment', compact('booking'));
    }
}