<?php

namespace App\Repositories;

use App\Interfaces\CardRepositoryInterface;

class CardRepository extends BaseRepository implements CardRepositoryInterface
{
    public function findBy(array $data)
    {
        $resources = $this->model;
        if (isset($data['customer_id']) && $data['customer_id'] !== '') {
            $resources = $resources->where('customer_id', $data['customer_id']);
        }
        return $resources->get();
    }
}
