<?php

namespace App\Repositories;

use App\Interfaces\SpecialtyCategoryRepositoryInterface;

class SpecialtyCategoryRepository extends BaseRepository implements SpecialtyCategoryRepositoryInterface
{
    public function getAll()
    {
        return $this->model::get();
    }
}
