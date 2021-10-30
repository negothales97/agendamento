<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $modelRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->modelRepository = $customerRepository;
    }

    public function register(RegisterRequest $registerRequest)
    {
        $customer = $this->modelRepository->store($registerRequest->validated());
        $customer->tokens()->delete();

        $token = $customer->createToken('token');
        return response()->json([
            'token' => $token->plainTextToken,
            'customer' => $customer
        ], 200);
    }
}
