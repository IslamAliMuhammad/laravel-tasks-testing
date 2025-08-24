<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function test_is_competed_returns_true_when_status_is_done() {
        // arrane
        $task = new \App\Models\Task();
        $task->status = 'done';
        // act
        $isCompleted = $task->is_completed;
        // assert
        $this->assertTrue($isCompleted);
        
    }

    public function test_is_completed_returns_fasle_when_status_is_not_done() {
        // arrane
        $task = new \App\Models\Task();
        $task->status = 'in_progress';
        // act
        $isCompleted = $task->is_completed;
        // assert
        $this->assertFalse($isCompleted);
    }
}
