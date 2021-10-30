<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function paginate(array $data = [], $per_page = 10)
    {
        $resources = $this->model;
        return $resources->paginate($per_page);
    }
}
