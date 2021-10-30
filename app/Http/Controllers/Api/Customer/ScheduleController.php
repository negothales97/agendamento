<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleConfirmationRequest;
use App\Interfaces\ScheduleRepositoryInterface;
use App\Models\Schedule;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    protected $scheduleService;
    protected $scheduleRepository;
    public function __construct(ScheduleService $scheduleService, ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleService = $scheduleService;
        $this->scheduleRepository = $scheduleRepository;
    }
    public function index()
    {
        $nextSchedule = $this->scheduleRepository->findBy([
            'status' => 1,
            'date' => date('Y-m-d'),
            'final_hour' => date('H:i'),
            'past' => false,
            'ordenation' => ['date', 'asc'],
            'relationship' => true
        ]);
        $pastSchedule = $this->scheduleRepository->findBy([
            'status' => 1,
            'date' => date('Y-m-d'),
            'final_hour' => date('H:i'),
            'past' => true,
            'ordenation' => ['date', 'desc'],
            'relationship' => true
        ]);

        return response()
            ->json([
                'nextSchedule' => $nextSchedule,
                'pastSchedule' => $pastSchedule,
            ]);
    }

    public function confirm(ScheduleConfirmationRequest $request, $id)
    {
        $result = $this->scheduleService->confirm($request->all(), $id);

        return response()->json($result);
    }

    public function valueRefund($id)
    {
        $values = $this->scheduleService->valueRefund($id);
        return response()->json([
            'values' => $values
        ]);
    }

    public function cancel($id)
    {
        $result = $this->scheduleService->refund($id);
        return response()->json([
            'schedule' => $result['schedule'],
            'transaction' => $result['transaction'],
        ]);
    }
}