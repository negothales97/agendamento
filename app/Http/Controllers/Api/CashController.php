<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Services\PagarMeService;
use Illuminate\Http\Request;

class CashController extends Controller
{
    protected $cardService;
    protected $customerRepository;
    protected $transactionRepository;

    public function __construct(PagarMeService $pagarMeService, CustomerRepositoryInterface $customerRepository, TransactionRepositoryInterface $transactionRepository)
    {
        $this->pagarMeService = $pagarMeService;
        $this->customerRepository = $customerRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function list()
    {
        $transactions = Transaction::where('customer_id', auth()->id())->get();
        return response()->json([
            'transactions' => $transactions
        ]);
    }
    public function add(Request $request)
    {
        $customer = auth()->user();
        $transaction = $this->pagarMeService->addCash($request->all());
        $customer = $this->customerRepository->update($customer->id, [
            'balance' => $customer->balance + $transaction->paid_amount
        ]);
        $this->transactionRepository->store([
            'transaction_id' => $transaction->id,
            'value' => $transaction->paid_amount,
            'type' => 'deposit',
            'description' => 'Depósito em conta',
            'customer_id' => auth()->id()
        ]);
        return response()
            ->json([
                'customer' => $customer
            ]);
    }
}
