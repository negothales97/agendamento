<?php

namespace App\Interfaces;

interface VariableRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function findOneBy($attribute, $value);
    public function update($id, array $data);
}
