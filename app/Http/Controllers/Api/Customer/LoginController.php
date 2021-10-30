<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $customer = Customer::where('email', $request->email)->first();
        if ($customer) {

            if (Hash::check($request->password, $customer->password)) {

                $customer->tokens()->delete();

                $token = $customer->createToken('token');
                return response()->json([
                    'token' => $token->plainTextToken,
                    'customer' => $customer
                ], 200);
            }
        }

        return response()->json([
            'error' => 'E-mail ou senha incorretos'
        ], 401);
    }

    public function logout()
    {
        $customer = auth()->user();
        if ($customer) {
            auth()->user()->tokens()->delete();
        }

        return response()->json([]);
    }
}
