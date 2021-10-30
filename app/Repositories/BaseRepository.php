<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findById($id)
    {
        return $this->model::find($id);
    }

    public function findOneBy($attribute, $value)
    {
        return $this->model::where($attribute, $value)->first();
    }

    public function store(array $data)
    {
        return $this->model::create($data);
    }
    public function update($id, array $data)
    {
        $resource = $this->findById($id);
        $resource->fill($data);
        $resource->save();

        return $resource;
    }

    public function delete($id)
    {
        $resource = $this->findById($id);
        return $resource->delete();
    }
}
