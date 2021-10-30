<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\TransactionRepositoryInterface;
use App\Services\DashboardService;
use App\Services\PagarMeService;
use Illuminate\Http\Request;

class BalanceController extends Controller
{

    protected $dashboardService;
    protected $pagarMeService;
    protected $transactionRepository;
    public function __construct(DashboardService $dashboardService, PagarMeService $pagarMeService, TransactionRepositoryInterface $transactionRepository)
    {
        $this->dashboardService = $dashboardService;
        $this->pagarMeService = $pagarMeService;
        $this->transactionRepository = $transactionRepository;
    }
    public function index()
    {
        $totalSchedules = $this->dashboardService->getTotalSchedules();
        $balance = $this->pagarMeService->getBalance(config('pagarme.recipient_id'));
        $transactions = $this->transactionRepository->paginate([
            'avivare' => true,
            'relationship' => true
        ]);
        $transactions = $transactions->filter(function ($transaction) {
            if ($transaction->type == 'transfer') {
                return $transaction->specialist_id == null;
            }
            return true;
        });
        return view('admin.pages.balance.index')
            ->with([
                'totalSchedules' => $totalSchedules,
                'balance' => $balance,
                'transactions' => $transactions,
            ]);
    }

    public function transfer(Request $request)
    {
        $amount = formatDecimalToInteger($request->amount);
        if ($amount == 0) {
            return back()
                ->with('error', 'O valor solicitado não é permitido para saque');
        }
        $transfer = $this->pagarMeService->transfer(config('pagarme.recipient_id'), $amount);
        $this->transactionRepository->store([
            'transaction_id' => $transfer->id,
            'value' => $transfer->amount,
            'type' => 'transfer',
            'description' => 'Resgate',
            'customer_id' => auth()->id()
        ]);
        return back()
            ->with('success', 'Solicitação de saque feita com sucesso');
    }
}
