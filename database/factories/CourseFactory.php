<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'category' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'duration' => $this->faker->randomElement(['4 weeks', '8 weeks', '12 weeks']),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'education'),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'instructor_name' => $this->faker->name,
            'published_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
        ];
    }
}
