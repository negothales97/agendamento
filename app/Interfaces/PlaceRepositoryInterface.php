<?php
namespace App\Interfaces;

interface PlaceRepositoryInterface
{
    public function paginate(array $data = [], $per_page = 20);
    public function findById($id);
    public function findOneBy($attribute, $value);
    public function findBy(array $data);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}
