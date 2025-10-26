<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'bio' => $this->faker->sentence(),
            'total_score' => $this->faker->numberBetween(0, 100000),
            'favorite_genre' => '歴史',
            'weakest_genre' => '科学',
        ];
    }
}
