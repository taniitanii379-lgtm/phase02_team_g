<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 外部キー制約を一時的に無効化
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 既存データをクリア
        DB::table('questions')->truncate();
        DB::table('quizzes')->truncate();

       // -------------------------
// 1. クイズタイトル (quizzesテーブル) の登録
// -------------------------

$quiz_data = [
    ['title' => '世界の首都クイズ (初級)', 'category_id' => 1, 'question' => ''],
    ['title' => '科学・自然クイズ (初級)', 'category_id' => 2, 'question' => ''],
];

DB::table('quizzes')->insert($quiz_data);

        // 登録されたクイズのIDを取得 (タイトルの昇順)
        $quizzes = DB::table('quizzes')->orderBy('title')->get();

        // -------------------------
        // 2. 問題 (questionsテーブル) の登録
        // -------------------------

        // クイズIDを効率的に探すためのマップ
        $quizMap = $quizzes->pluck('id', 'title')->toArray();

        $questions_to_insert = [];

        // --- クイズ1: 世界の首都クイズ ---
        $quizId1 = $quizMap['世界の首都クイズ (初級)'] ?? 1;
        $questions_to_insert[] = ['quiz_id' => $quizId1, 'question' => '日本の首都は東京ですか？', 'answer' => 1];
        $questions_to_insert[] = ['quiz_id' => $quizId1, 'question' => 'アメリカの首都はニューヨークですか？', 'answer' => 0];
        $questions_to_insert[] = ['quiz_id' => $quizId1, 'question' => 'フランスの首都はパリですか？', 'answer' => 1];
        $questions_to_insert[] = ['quiz_id' => $quizId1, 'question' => '中国の首都は上海ですか？', 'answer' => 0];

        // --- クイズ2: 科学・自然クイズ ---
        $quizId2 = $quizMap['科学・自然クイズ (初級)'] ?? 2;
        $questions_to_insert[] = ['quiz_id' => $quizId2, 'question' => '水の化学式はH2Oですか？', 'answer' => 1];
        $questions_to_insert[] = ['quiz_id' => $quizId2, 'question' => '地球は太陽の周りを回っていますか？', 'answer' => 1];
        $questions_to_insert[] = ['quiz_id' => $quizId2, 'question' => '氷は水に浮きますか？', 'answer' => 1];
        
        DB::table('questions')->insert($questions_to_insert);

        // 外部キー制約を元に戻す
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}