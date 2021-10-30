<?php

namespace App\Repositories;

use App\Interfaces\SpecialistRepositoryInterface;

class SpecialistRepository extends BaseRepository implements SpecialistRepositoryInterface
{
    public function paginate(array $data = [], $per_page = 10)
    {
        $resources = $this->model;
        if (isset($data['search']) && $data['search'] !== '') {
            $resources = $resources->where('specialists.name', 'like', "%{$data['search']}%");
            $resources = $resources->leftJoin('places',  'places.specialist_id', '=', 'specialists.id')
                ->orWhere(function ($query) use ($data) {
                    $query->orWhere('street', 'like', "%{$data['search']}%")
                        ->orWhere('places.name', 'like', "%{$data['search']}%");
                });
        }
        if (isset($data['specialty_category_id']) && $data['specialty_category_id'] !== null) {
            $resources = $resources->where('specialists.specialty_category_id', "{$data['specialty_category_id']}");
        }
        if (isset($data['specialty_id']) && $data['specialty_id'] !== null) {
            $resources = $resources->where('specialists.specialty_id', "{$data['specialty_id']}");
        }
        if (isset($data['relationship']) && $data['relationship'] == 'true') {
            $resources = $resources->with(['places', 'category']);
        }
        return $resources->distinct()->select('specialists.*')->paginate($per_page);
    }

    public function get(array $data = [])
    {
        $resources = $this->model;

        return $resources->get();
    }

    public function findById($id)
    {
        return $this->model::where('id', $id)->with(['category', 'places'])->first();
    }
}
