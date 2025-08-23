<?php

// app/Repositories/TaskRepository.php
namespace App\Repositories;

use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function create(array $data)
    {
        $data['user_id'] = auth()->id();
        
        return Task::create($data);
    }

    public function getAllForUser($userId)
    {
        return Task::where('user_id', $userId)->get();
    }

    public function find($id)
    {
        return Task::find($id);
    }
}
