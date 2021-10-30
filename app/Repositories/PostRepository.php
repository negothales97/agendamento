<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function paginate(array $data =[], $per_page = 10)
    {
        $resources = $this->model;
        return $resources->paginate($per_page);
    }

}
