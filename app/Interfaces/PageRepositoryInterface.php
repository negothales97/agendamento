<?php

namespace App\Interfaces;

interface PageRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function findOneBy($attribute, $value);
    public function update($id, array $data);
}
