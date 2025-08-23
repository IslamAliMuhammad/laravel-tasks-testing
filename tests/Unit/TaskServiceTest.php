<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use App\Repositories\Interfaces\TaskRepositoryInterface; 
use App\Services\TaskService; 
use App\Models\Task; 

class TaskServiceTest extends TestCase
{

    public function test_task_creation()
    {
        $repo = Mockery::mock(TaskRepositoryInterface::class);

        $repo->shouldReceive('create')->once()->with([
            'title' => 'Test',
            'description' => 'Test description'
        ])->andReturn(new Task());

        $service = new TaskService($repo);
        
        $result = $service->createTask([
            'title' => 'Test',
            'description' => 'Test description'
        ]);

        $this->assertInstanceOf(Task::class, $result);
    }
}
