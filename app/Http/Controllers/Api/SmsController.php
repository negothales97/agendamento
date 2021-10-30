<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SmsService;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    protected $smsService;
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }
    public function send(Request $request)
    {
        $code = generateRandomCode();
        $cellphone = clearSpecialCaracteres($request->cellphone);
        $result = $this->smsService->sendCode($code, $cellphone);

        return response()->json([
            'code' => $code,
            'result' => $result,
        ]);
    }
}
