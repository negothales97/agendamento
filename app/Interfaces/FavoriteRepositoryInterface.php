<?php

namespace App\Interfaces;

interface FavoriteRepositoryInterface
{
    public function findById($id);
    public function findOneBy($attribute, $value);
    public function findBy(array $data);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function updateOrCreate(array $data);
}
