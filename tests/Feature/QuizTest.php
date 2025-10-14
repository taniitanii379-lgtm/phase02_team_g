<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuizTest extends TestCase
{
     use RefreshDatabase;    
    use WithoutMiddleware;    
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_quiz_can_be_created(): void
    {
        $response = $this->post('/quizzes', [
            'question' => 'Laravelとは何ですか？',
            'choices' => ['PHPのフレームワーク', 'JavaScriptのライブラリ', 'CSSのプリプロセッサ'],
            'answer' => 0,
        ]);

        $response->assertRedirect('/quizzes');

        $this->assertDatabaseHas('quizzes', [
            'question' => 'Laravelとは何ですか？',
            'answer' => 0,
        ]);
    }
}
