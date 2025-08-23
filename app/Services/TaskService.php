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

    public function getAllTasks()
    {
        return $this->taskRepo->all();
    }
}
