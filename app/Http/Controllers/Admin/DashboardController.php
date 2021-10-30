<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\PagarMeService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;
    protected $pagarMeService;
    public function __construct(DashboardService $dashboardService, PagarMeService $pagarMeService)
    {
        $this->dashboardService = $dashboardService;
        $this->pagarMeService = $pagarMeService;
    }
    public function index()
    {
        $totalSchedules = $this->dashboardService->getTotalSchedules();
        $lastSchedules = $this->dashboardService->getLastSchedules();
        $balance = $this->pagarMeService->getBalance(config('pagarme.recipient_id'));

        return view('admin.pages.dashboard.index')
            ->with([
                'totalSchedules' => $totalSchedules,
                'lastSchedules' => $lastSchedules,
                'balance' => $balance
            ]);
    }
}
