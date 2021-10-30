<?php

namespace App\Services;

use Comtele\Services\TextMessageService;

class SmsService
{
    public function sendCode($code, $cellphone)
    {
        $apiKey = config('sms.api_key');
        $textMessageService = new TextMessageService($apiKey);
        $result = $textMessageService->send(
            "5511998103532",
            "Avivare: Seu código de verificação é {$code}",
            ["55{$cellphone}"]
        );
        return $result;
    }
}
