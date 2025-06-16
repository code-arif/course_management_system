<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['text', 'image', 'video', 'link', 'pdf', 'quiz'];

        return [
            'type' => $this->faker->randomElement($types),
            'title' => $this->faker->sentence(3),
            'value' => $this->faker->url,
            'duration' => $this->faker->randomElement(['10 mins', '20 mins', '30 mins']),
        ];
    }
}
