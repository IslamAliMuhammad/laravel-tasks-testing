<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

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

        return TaskResource::make($task);
    }

    public function index()
    {
        $userId = auth()->id();
        $status = request()->get('status'); 
        $perPage = request()->get('per_page', 15);


        $tasks = $this->taskService->getAllTasks($userId, $perPage, $status);

        return TaskResource::collection($tasks);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        if ($request->user()->cannot('update', $task)) {
            abort(403);
        }

        $task = $this->taskService->updateTask($task->id, $request->validated());

        return TaskResource::make($task);
    }
}
