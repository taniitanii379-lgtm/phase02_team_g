<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
 $choices = [
            $this->faker->words(2, true),
            $this->faker->words(2, true),
            $this->faker->words(2, true),
            $this->faker->words(2, true),
        ];
        return [
            'question' => $this->faker->sentence(6, true),
            'choices' => $choices,
            'answer' => $this->faker->numberBetween(0, count($choices) - 1),
        ];
    }
}
