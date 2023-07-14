<?php

namespace Tests\Feature\HttpApi;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Factories\BoardFactory;
use Database\Factories\TaskFactory;
use Domain\Task\Model\Board;
use Domain\Task\Model\Task;
use App\Models\User;
use Tests\TestCase;

class TestTaskController extends TestCase
{
    use DatabaseTransactions;

    /**
     * Setup test requirements
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /**
     * Test creating task using the routes defined and provide required fields
     *
     * @return void
     */
    public function testCreatingNewTask(): void
    {
        $taskData = [
            'title' => 'Test',
            'description' => 'Test',
            'dueDate' => now()->toDateString(),
        ];

        $this->postJson('/api/tasks', $taskData)
            ->assertOk(200);

        $this->assertDatabaseHas('tasks', [
            'title' => $taskData['title'],
            'description' => $taskData['description'],
            'due_date' => $taskData['dueDate'],
        ]);
    }

    /**
     * Test logging in successfully using the routed defined
     *
     * @return void
     */
    public function testOrderIsCorrectWhenCreatingTasks(): void
    {
        /** @var Board $board */
        $board = (new BoardFactory())->create();

        /** @var Task $task1 */
        $task1 = (new TaskFactory())->create([
            'board_id' => 1,
        ]);

        $task2 = [
            'title' => 'Test 2',
            'description' => 'Test 2',
            'dueDate' => now()->toDateString(),
        ];

        $this->postJson('/api/tasks', $task2)
            ->assertOk();

        $task1->refresh();

        $this->assertDatabaseHas('tasks', [
            'title' => $task2['title'],
            'description' => $task2['description'],
            'due_date' => $task2['dueDate'],
        ]);

        $this->assertEquals(1, $task1->order);
    }

    /**
     * Test deleting a task using the route defined
     *
     * @return void
     */
    public function testDelete(): void
    {
        /** @var Task $task */
        $task = (new TaskFactory())->create();
        $this->deleteJson("/api/tasks/{$task->id}")
            ->assertOk();

        $this->assertSoftDeleted('tasks', [
            'id' => $task->id,
        ]);
    }

    /**
     * Test updating a task using the route defined
     *
     * @return void
     */
    public function testUpdatingATask(): void
    {
        /** @var Task $task */
        $task = (new TaskFactory())->create();

        $formData = [
            'title' => 'test',
            'dueDate' => now()->addDays(30)->toDateString(),
        ];

        $this->putJson("/api/tasks/{$task->id}", $formData)
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'title' => $formData['title'],
            'due_date' => $formData['dueDate'],
        ]);
    }
}
