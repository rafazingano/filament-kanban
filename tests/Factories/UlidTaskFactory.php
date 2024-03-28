<?php

namespace Rafazingano\FilamentKanban\Tests\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rafazingano\FilamentKanban\Tests\Enums\TaskStatus;
use Rafazingano\FilamentKanban\Tests\Models\UlidTask;

class UlidTaskFactory extends Factory
{
    protected $model = UlidTask::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'status' => fake()->randomElement(TaskStatus::cases()),
        ];
    }

    public function todo()
    {
        return $this->state(fn (array $attributes) => [
            'status' => TaskStatus::Todo,
        ]);
    }

    public function doing()
    {
        return $this->state(fn (array $attributes) => [
            'status' => TaskStatus::Doing,
        ]);
    }

    public function done()
    {
        return $this->state(fn (array $attributes) => [
            'status' => TaskStatus::Done,
        ]);
    }
}
