<?php
namespace App\Interfaces;

interface SpecialtyCategoryRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function findOneBy($attribute, $value);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}
