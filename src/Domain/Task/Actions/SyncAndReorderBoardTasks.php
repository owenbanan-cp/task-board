<?php

namespace Domain\Task\Actions;

use Illuminate\Http\Request;
use Domain\Task\Model\Board;
use Domain\Task\Model\Task;

class SyncAndReorderBoardTasks
{
    /**
     * Sync and reorder all the task in board
     *
     * @param Request $request
     * @param Board $board
     * @return void
     */
    public function __invoke(Request $request,  Board $board): void
    {
        foreach ($request->input('tasks') as $index => $taskId) {
            Task::query()
                ->find($taskId)
                ->fill([
                    'board_id' => $board->id,
                    'order' => $index,
                ])
                ->save();
        }
    }
}
