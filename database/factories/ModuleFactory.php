<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(2),
            'summary' => $this->faker->paragraph(2),
            'duration' => $this->faker->randomElement(['1 hour', '2 hours', '3 hours']),
            'status' => $this->faker->randomElement(['draft', 'published']),
        ];
    }
}
