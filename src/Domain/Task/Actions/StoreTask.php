<?php

namespace Domain\Task\Actions;

use Domain\Task\HttpApi\Requests\StoreTaskRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Domain\Task\Model\Task;
use Carbon\Carbon;

class StoreTask
{
    public function __invoke(StoreTaskRequest $storeTaskRequest): Model|Builder
    {
        /** @var Task $createdTask */
        $createdTask = Task::query()->create([
            'title' => $storeTaskRequest->input('title'),
            'due_date' => Carbon::parse($storeTaskRequest->input('dueDate'))->toDateString(),
            'description' => $storeTaskRequest->input('description'),
            'board_id' => 1,
            'order' => 0,
        ]);

        $tasks = Task::query()
            ->where('board_id', $createdTask->board_id)
            ->where('id', '!=', $createdTask->id)
            ->get();
        foreach ($tasks as $task) {
            $task->update(['order' => ($task->order + 1)]);
        }

        return $createdTask;
    }
}
