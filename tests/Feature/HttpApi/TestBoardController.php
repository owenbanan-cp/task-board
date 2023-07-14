<?php

namespace HttpApi;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Factories\BoardFactory;
use Database\Factories\TaskFactory;
use App\Models\User;
use Tests\TestCase;

class TestBoardController extends TestCase
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
     * Set if reordering task works properly
     *
     * @return void
     */
    public function testReorderTasks(): void
    {
        $board = (new BoardFactory())->create();

        $task1 = (new TaskFactory())->create(['board_id' => $board->id, 'order' => 0]);
        $task2 = (new TaskFactory())->create(['board_id' => $board->id, 'order' => 1]);
        $task3 = (new TaskFactory())->create(['board_id' => $board->id, 'order' => 2]);

        $taskIds = [$task3->id, $task2->id, $task1->id];

        $this->putJson("/api/boards/{$board->id}/sync-and-reorder-tasks", ['tasks' => $taskIds])
            ->assertOk();

        $task1->refresh();
        $task2->refresh();
        $task3->refresh();

        $this->assertEquals(0, $task3->order);
        $this->assertEquals(1, $task2->order);
        $this->assertEquals(2, $task1->order);
    }
}
