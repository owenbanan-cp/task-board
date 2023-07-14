<?php

use Illuminate\Database\Migrations\Migration;

class AddPreDefinedBoards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $boards = [
            'Todo',
            'In-Progress',
            'Done',
        ];

        foreach ($boards as $index => $board) {
            \Domain\Task\Model\Board::query()->create([
                'name' => $board,
                'order' => $index
            ]);
        }
    }
}
