<?php

namespace App\Services;

use App\Interfaces\SpecialistRepositoryInterface;
use App\Interfaces\PlaceRepositoryInterface;

class PlaceService
{
    protected $placeRepository;
    protected $specialistRepository;
    public function __construct(PlaceRepositoryInterface $placeRepository, SpecialistRepositoryInterface $specialistRepository)
    {
        $this->placeRepository = $placeRepository;
        $this->specialistRepository = $specialistRepository;
    }

    public function updateOnline(int $id)
    {
        $specialist = $this->specialistRepository->findById($id);
        $data['use_online'] = $specialist->use_online == 0;
        $this->specialistRepository->update($id, $data);
    }

    public function updateStatus(int $id)
    {
        $place = $this->placeRepository->findById($id);
        $data['status'] = $place->status == 0;
        $this->placeRepository->update($id, $data);
    }
}
