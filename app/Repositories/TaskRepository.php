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
        $task = Task::create($data);

        return TaskResource::make($task);
    }
}
