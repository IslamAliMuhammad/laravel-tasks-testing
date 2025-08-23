<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function create(array $data);

    public function getAllForUser($userId);

    public function find($id);
}
