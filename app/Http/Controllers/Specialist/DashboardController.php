<?php

namespace App\Http\Controllers\Specialist;

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
        $id = auth('specialist')->id();
        $totalSchedules = $this->dashboardService->getTotalSchedules($id);
        $lastSchedules = $this->dashboardService->getLastSchedules($id);
        $balance = $this->pagarMeService->getBalance(auth('specialist')->user()->recipient_id);

        return view('specialist.pages.dashboard.index')
            ->with([
                'totalSchedules' => $totalSchedules,
                'lastSchedules' => $lastSchedules,
                'balance' => $balance,
            ]);
    }
}
