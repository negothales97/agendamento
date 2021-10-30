<?php

namespace App\Interfaces;

interface SpecialistRepositoryInterface
{
    public function paginate(array $data = [], $per_page = 10);
    public function get(array $data = []);
    public function findById($id);
    public function findOneBy($attribute, $value);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}
