<?php

namespace App\Http\Controllers\Specialist;

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
        $id = auth('specialist')->id();
        $totalSchedules = $this->dashboardService->getTotalSchedules($id);
        $balance = $this->pagarMeService->getBalance(auth('specialist')->user()->recipient_id);
        $transactions = $this->transactionRepository->paginate([
            'specialist_id' => $id,
            'relationship' => true
        ]);

        return view('specialist.pages.balance.index')
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
                ->with('error', 'O valor solicitado não é permitido para resgate.');
        }
        $this->pagarMeService->transfer(auth('specialist')->user()->recipient_id, $amount);
        return back()
            ->with('success', 'Solicitação de saque feita com sucesso');
    }
}
