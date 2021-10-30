<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Interfaces\ScheduleRepositoryInterface;
use App\Services\AgoraDynamicKey\RtcTokenBuilder;
use App\Services\ScheduleService;

class CallController extends Controller
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
        $schedules = $this->scheduleRepository->findBy([
            'date' => now(),
            'final_hour' => date('H:i'),
            'past' => false,
            'relationship' => true,
            'generated' => true
        ]);

        return view('specialist.pages.call.index', compact(
            'schedules'
        ));
    }

    public function show($id)
    {
        $schedule = $this->scheduleService->getSceduleTokenAgoraIo($id);

        return view('specialist.pages.call.show', compact(
            'schedule'
        ));
    }
}
