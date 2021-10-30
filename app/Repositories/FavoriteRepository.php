<?php

namespace App\Repositories;

use App\Interfaces\FavoriteRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FavoriteRepository extends BaseRepository implements FavoriteRepositoryInterface
{
    public function findBy(array $data)
    {
        $resources = $this->model;
        if(isset($data['customer_id']) && $data['customer_id'] != ''){
            $resources = $resources->where('customer_id', $data['customer_id']);
        }
        if(isset($data['relationship']) && $data['relationship']){
            $resources = $resources->with(['customer', 'specialist']);
        }
        return $resources->get();
    }
    public function updateOrCreate(array $data)
    {
        $favorite = $this->model::where([
            'customer_id' => $data['customer_id'],
            'specialist_id' => $data['specialist_id'],
        ])->first();

        if ($favorite) {
            $favorite = $this->update(
                $favorite->id,
                [
                    'status' => $favorite->status == 0
                ]
            );
        } else {
            $data['status'] = true;
            $favorite = $this->store($data);
        }

        return $favorite;
    }
}
