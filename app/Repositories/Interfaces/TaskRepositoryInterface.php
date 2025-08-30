<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function create(array $data);

    public function getAllForUser($userId, $perPage = 15, $status = null);

    public function find($id);
}
