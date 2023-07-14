<?php

namespace Domain\Task\HttpApi\Controllers;

use Domain\Task\HttpApi\Requests\UpdateTaskRequest;
use Domain\Task\HttpApi\Requests\StoreTaskRequest;
use App\Http\Controllers\Controller;
use Domain\Task\HttpApi\Resources\TaskResource;
use Illuminate\Support\Facades\Log;
use Domain\Task\Actions\UpdateTask;
use Domain\Task\Actions\StoreTask;
use Illuminate\Http\Response;
use Domain\Task\Model\Task;

class TaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskRequest $storeTaskRequest
     * @param StoreTask $storeTask
     * @return TaskResource
     */
    public function store(StoreTaskRequest $storeTaskRequest, StoreTask $storeTask): TaskResource
    {
        try {
            return (new TaskResource(($storeTask)($storeTaskRequest)));
        } catch (\Exception $exception) {
            Log::debug("[TaskController@store] {$exception->getMessage()}");

            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskRequest $updateTaskRequest $
     * @param Task $task
     * @param UpdateTask $updateTask
     * @return TaskResource|void
     */
    public function update(UpdateTaskRequest $updateTaskRequest, Task $task, UpdateTask $updateTask)
    {
        try {
            return (new TaskResource(($updateTask)($updateTaskRequest, $task)));
        } catch (\Exception $exception) {
            Log::debug("[TaskController@update] {$exception->getMessage()}");

            abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return Response
     */
    public function destroy(Task $task): Response
    {
        try {
            $task->delete();
            return response()->noContent(200);
        } catch (\Exception $exception) {
            Log::debug("[TaskController@destroy] {$exception->getMessage()}");

            abort(500);
        }
    }
}
