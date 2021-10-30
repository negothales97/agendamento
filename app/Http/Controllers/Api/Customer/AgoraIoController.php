<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Services\ScheduleService;

class AgoraIoController extends Controller
{

    protected $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }
    public function generateToken($id)
    {
        $schedule = $this->scheduleService->getSceduleTokenAgoraIo($id);
        return response()
            ->json([
                'schedule' => $schedule,
                'agoraio_app_id' => config('agoraio.app_id')
            ]);
    }
}
