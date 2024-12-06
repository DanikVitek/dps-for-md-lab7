<?php

namespace Database\Factories;

use App\Models\Enum\TodoStatus;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\Randomizer;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->boolean(40) ? fake()->sentences(asText: true) : null,
            'status' => TodoStatus::cases()[new Randomizer()->getInt(0, 2)]
        ];
    }
}
