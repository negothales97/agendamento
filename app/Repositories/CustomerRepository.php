<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function paginate(array $data = [], $per_page = 10)
    {
        $resources = $this->model;
        return $resources->paginate($per_page);
    }
}
