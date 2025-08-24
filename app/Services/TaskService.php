<?php

// app/Services/TaskService.php
namespace App\Services;

use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskService
{
    protected $taskRepo;

    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function createTask(array $data)
    {
        return $this->taskRepo->create($data);
    }

    public function getAllTasks($userId)
    {
        return $this->taskRepo->getAllForUser($userId);
    }

    public function updateTask($id, array $data)
    {
        $task = $this->taskRepo->find($id);

        if ($task) {
            $task->update($data);
        }

        return $task;
    }

    public function findTask($id)
    {
        return $this->taskRepo->find($id);
    }

   
}
