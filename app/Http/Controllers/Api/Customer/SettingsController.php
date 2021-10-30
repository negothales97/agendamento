<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $customerRepository;
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function update(SettingsRequest $request)
    {
        $customer = $this->customerRepository->update(auth()->id(), $request->validated());
        return response()->json(['customer' => $customer]);
    }
}
