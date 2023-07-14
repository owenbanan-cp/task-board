<?php

namespace Domain\Task\HttpApi\Controllers;

use Domain\Task\HttpApi\Resources\BoardCollection;
use Domain\Task\Actions\SyncAndReorderBoardTasks;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Domain\Task\Model\Board;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BoardCollection
     */
    public function index(): BoardCollection
    {
        $boards = Board::query()
            ->orderBy('order', 'asc')
            ->with(['tasks' => fn ($query) => $query->orderBy('order', 'asc') ])
            ->get();

        return new BoardCollection($boards);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Board $board
     * @param SyncAndReorderBoardTasks $syncAndReorderBoardTasks
     * @return Response
     */
    public function syncTaskAndReorder(
        Request $request,
        Board $board,
        SyncAndReorderBoardTasks $syncAndReorderBoardTasks
    ): Response {
        try {
            ($syncAndReorderBoardTasks)($request, $board);
            return response()->noContent(200);
        } catch (\Exception $exception) {
            Log::debug("[BoardController@syncTaskAndReorder] {$exception->getMessage()}");

            abort(500);
        }

    }
}
