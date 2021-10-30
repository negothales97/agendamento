<?php

namespace App\Repositories;

use App\Interfaces\SpecialtyRepositoryInterface;

class SpecialtyRepository extends BaseRepository implements SpecialtyRepositoryInterface
{
    public function paginate(array $data = [], $per_page = 10)
    {
        $resources = $this->model;
        return $resources->paginate($per_page);
    }
    public function getAll()
    {
        $resources = $this->model;
        return $resources->get();
    }

    public function findById($id)
    {
        return $this->model::where('id',$id)->with(['categories'])->first();
    }
}
