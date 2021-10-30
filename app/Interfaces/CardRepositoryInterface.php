<?php

namespace App\Interfaces;

interface CardRepositoryInterface
{
    public function store(array $data);
    public function findBy(array $data);
    public function delete($id);
}
