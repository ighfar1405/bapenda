<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WaService
{
    protected $apikey;

    protected $apiurl;

    public function __construct()
    {
        $this->apikey = config('wa.wa_apikey');
        $this->apiurl = config('wa.wa_apiurl');
    }

    public function kirim($message, $phone)
    {
        return $this->curl_post($phone, $message);
        // return @file_get_contents($this->apiurl . '?' . http_build_query(['token' => $this->apikey, 'no' => $phone, 'text' => $message]));
    }

    private function curl_post($phone, $message)
    {
        $url = $this->apiurl . '?' . http_build_query(['token' => $this->apikey, 'no' => $phone, 'text' => $message]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);

        return $data;
    }
}
