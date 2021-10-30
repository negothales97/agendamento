<?php

namespace App\Repositories;

use App\Interfaces\PlaceRepositoryInterface;

class PlaceRepository extends BaseRepository implements PlaceRepositoryInterface
{
    public function paginate(array $data = [], $per_page = 20)
    {
        $resources = $this->filter($data, $this->model);
        return $resources->paginate($per_page);
    }

    public function findBy(array $data)
    {
        $resources = $this->filter($data, $this->model);
        return $resources->get();
    }

    protected function filter(array $data, $resources)
    {
        if (isset($data['specialist_id']) && $data['specialist_id'] != '') {
            $resources = $resources->where('specialist_id', $data['specialist_id']);
        }
        return $resources;
    }
}
