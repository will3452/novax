<?php

namespace App\Services;


class Payment
{
    public function __construct()
    {
        $this->key = 'pk_0bb2b3dc69995ca960daa40a5f1b759d';
    }

    public static function make () {
        return (new Payment());
    }

    public $key = '';
    public $amount = 1;
    public $description = "";

    public function setAmount ($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
        return $this;
    }

    public function gcash () {

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
                'x-public-key' => $this->key,
                'amount' => $this->amount,
                'description' => $this->description,
                'webhooksuccessurl' => url('/api/gcash'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
