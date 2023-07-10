<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3, true),
            'content' => $this->faker->sentences(4, true),
            'likes' => $this->faker->numberBetween(20, 5000),
            'owner' => $this->faker->numberBetween(1,6),
        ];
    }
}
