<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Interfaces\FavoriteRepositoryInterface;
use App\Interfaces\PlaceRepositoryInterface;
use App\Interfaces\ScheduleRepositoryInterface;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $modelRepository;
    protected $placeRepository;
    protected $favoriteRepository;

    public function __construct(
        ScheduleRepositoryInterface $scheduleRepository,
        PlaceRepositoryInterface $placeRepository,
        FavoriteRepositoryInterface $favoriteRepository
    ) {
        $this->modelRepository = $scheduleRepository;
        $this->placeRepository = $placeRepository;
        $this->favoriteRepository = $favoriteRepository;
    }

    public function index($specialist_id, Request $request)
    {
        $data = $request->all() + ['specialist_id' => $specialist_id];

        $schedules = $this->modelRepository->findBy($data);
        $places = $this->placeRepository->findBy($data);

        return response()->json([
            'schedules' => $schedules,
            'places' => $places
        ]);
    }
    public function store(ScheduleRequest $scheduleRequest)
    {
        $schedule = $this->modelRepository->store($scheduleRequest->validated());
        return response()->json(['schedule' => $schedule]);
    }
    public function show($id)
    {
        $schedule = $this->modelRepository->findById($id);
        return response()->json(['schedule' => $schedule]);
    }
    public function update(ScheduleRequest $scheduleRequest, $id)
    {
        $schedule = $this->modelRepository->update($id, $scheduleRequest->validated());
        return response()->json(['schedule' => $schedule]);
    }
    public function delete($id)
    {
        $this->modelRepository->delete($id);
        return response()->json(null);
    }

}
