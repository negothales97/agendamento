<?php

namespace App\Repositories;

use App\Interfaces\PageRepositoryInterface;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    public function getAll()
    {
        return $this->model::get();
    }
}
