<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'long_description'=> fake()->paragraph(7, true),
            'completed' => fake()->boolean
        ];
    }
}

// Model Factory provides fake datas for your models
// then, the seeder will take the responsibility to load this fake data into the database