<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $modelRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->modelRepository = $customerRepository;
    }

    public function getUser()
    {
        $customer = auth()->user();

        return response()->json([
            'customer' => $customer
        ]);
    }

    public function update(CustomerRequest $request)
    {
        $id = auth()->id();
        $customer = $this->modelRepository->update($id, $request->all());
        return response(['customer' => $customer]);
        return response([], 401);
    }

    public function refreshToken()
    {
        $customer = auth()->user();
        $customer->tokens()->delete();

        $token = $customer->createToken('token');

        return response()->json([
            'token' => $token->plainTextToken,
            'customer' => $customer
        ], 200);
    }
}
