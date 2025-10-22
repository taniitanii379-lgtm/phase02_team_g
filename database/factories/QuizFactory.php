<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class QuizFactory extends Factory
{
    public function definition(): array
    {
        $choices = ['選択肢A', '選択肢B', '選択肢C'];

        return [
            'title' => $this->faker->sentence(3),
            'question' => $this->faker->sentence(),
            'choices' => $choices,
            'answer' => 0,
            'category_id' => Category::factory(), // カテゴリも自動で作る
        ];
    }
}
