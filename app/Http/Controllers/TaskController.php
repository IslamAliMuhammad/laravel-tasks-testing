<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\TaskStoreRequest;
use App\Services\TaskService;

class TaskController extends Controller
{

    protected $taskService;

     public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(TaskStoreRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());

          return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }
}
