<?php

namespace App\Repositories;

use App\Interfaces\VariableRepositoryInterface;

class VariableRepository extends BaseRepository implements VariableRepositoryInterface
{
    public function getAll()
    {
        return $this->model::get();
    }
}
