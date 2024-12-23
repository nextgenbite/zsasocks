<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
class SMSService
{
    public function sendSMS($phoneNumber, $message)
    {
        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = "otujIpeW9z6j0A56lJQ9";
        $senderid = "8809617622600";

        
        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $phoneNumber,
            "message" => $message
        ];

        $response = Http::post($url, $data);

        return $response->body();
    }
}
