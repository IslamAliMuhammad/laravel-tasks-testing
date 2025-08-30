<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function create(array $data);

    public function getAllForUser($userId, $perPage = 15);

    public function find($id);
}
