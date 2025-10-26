<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\User;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_quiz_can_be_created()
    {
        $this->actingAs(User::factory()->create());

        $category = Category::factory()->create();

        $response = $this->post(route('quizzes-management.store'), [
            'title' => 'ことわざクイズ第1問',
            'category_id' => $category->id,
            'questions' => [
                [
                    'question' => '犬も歩けば…？',
                    'choices' => ['棒に当たる', '猫に小判', '猿も木から落ちる'],
                    'answer' => 0,
                ],
            ],
        ]);

        // リダイレクト確認
        $response->assertRedirect(route('quizzes-management.index'));

        // DB に保存されたか確認
        $this->assertDatabaseHas('quizzes', [
            'title' => 'ことわざクイズ第1問',
            'category_id' => $category->id,
        ]);

        $quiz = Quiz::first();
        $this->assertEquals('犬も歩けば…？', $quiz->questions->first()->question);
        $this->assertEquals(['棒に当たる', '猫に小判', '猿も木から落ちる'], $quiz->questions->first()->choices);
        $this->assertEquals(0, $quiz->questions->first()->answer);
    }

    /** @test */
    public function test_quiz_validation_fails_with_invalid_data()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('quizzes-management.store'), [
            // 空データ送信
            'title' => '',
            'category_id' => null,
            'questions' => [], // 空配列で questions バリデーションに引っかかる
        ]);

        $response->assertSessionHasErrors([
            'title',
            'questions',
        ]);
    }
}
