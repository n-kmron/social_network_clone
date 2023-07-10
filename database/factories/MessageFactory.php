<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => $this->faker->numberBetween(1,6),
            'channel_id' => $this->faker->numberBetween(1,5),
            'content' => $this->faker->sentences(1, true),
        ];
    }
}
