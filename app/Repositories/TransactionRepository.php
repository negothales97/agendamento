<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    public function paginate(array $data = [], $per_page = 10)
    {
        $resources = $this->model;
        if (isset($data['specialist_id']) && $data['specialist_id'] != '') {
            $resources = $resources->where('specialist_id', $data['specialist_id']);
        }
        // if (isset($data['avivare']) && $data['avivare'] == true) {
        //     $resources = $resources
        //         ->whereRaw("IF(type = 'transfer', specialist_id,null) <> null");
        // }
        if (isset($data['relationship']) && $data['relationship'] == true) {
            $resources = $resources->with(['customer', 'schedule']);
        }
        return $resources->orderBy('created_at', 'desc')->paginate($per_page);
    }
}
