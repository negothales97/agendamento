<?php

namespace App\Interfaces;

interface ScheduleRepositoryInterface
{
    public function findById($id);
    public function findBy(array $data);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}
