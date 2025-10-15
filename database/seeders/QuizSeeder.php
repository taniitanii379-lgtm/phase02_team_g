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
       DB::table('categories')->insert([
    'name' => '未分類',
    'created_at' => now(),
    'updated_at' => now(),
]);

$categoryId = DB::table('categories')->first()->id;

DB::table('quizzes')->insert([
    [
        'title' => '1 + 1 = ?',
        'question' => '足し算の基本問題です。',
        'category_id' => $categoryId,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'title' => '水の沸点は？',
        'question' => '常圧での沸点を答えましょう。',
        'category_id' => $categoryId,
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);

    }
}
