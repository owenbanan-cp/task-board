<?php

namespace Domain\Task\Actions;

use Carbon\Carbon;
use Domain\Task\HttpApi\Requests\UpdateTaskRequest;
use Domain\Task\Model\Task;
use Illuminate\Support\Str;

class UpdateTask
{
    /**
     * Update the tasks
     *
     * @param UpdateTaskRequest $updateTaskRequest
     * @param Task $task
     * @return Task
     */
    public function __invoke(UpdateTaskRequest $updateTaskRequest, Task $task): Task
    {
        $requestData = [];

        foreach ($updateTaskRequest->all() as $key => $value) {
            if ($key === 'dueDate') {
                $requestData[Str::snake($key)] = Carbon::parse($value)->toDateString();
            }

            if ($key !== 'dueDate') {
                $requestData[Str::snake($key)] = $value;
            }
        }

        $task->update($requestData);
        $task->save();

        return $task;
    }
}
