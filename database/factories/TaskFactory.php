<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Task\Model\Task;

class TaskFactory extends Factory
{
    /**
     * Set the model of the factory.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'board_id' => (new BoardFactory())->create(),
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph,
            'due_date' => $this->faker->date,
            'order' => 0,
        ];
    }
}
