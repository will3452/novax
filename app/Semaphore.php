<?php

namespace App;

class Semaphore
{
    public $curl;
    public $param;
    const ENDPOINT = 'https://semaphore.co/api/v4/messages';

    public function __construct(string $number, $message = 'testing')
    {
        $this->curl = curl_init();
        $this->param = array(
            'apikey' => env('SEMAPHORE_APIKEY'),
            'number' => $number,
            'message' => $message,
            'sendername' => env('SEMAPHORE_SENDER_NAME'),
        );
        $this->setupCurl();
    }

    public function setupCurl()
    {
        curl_setopt($this->curl, CURLOPT_URL, self::ENDPOINT);
        curl_setopt($this->curl, CURLOPT_POST, 1 );
    }

    public function setMessage(string $message)
    {
        $this->param['message'] = $message;
    }

    public function send()
    {
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($this->param));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec($this->curl);
        curl_close ($this->curl);
        return $output;
    }
}
