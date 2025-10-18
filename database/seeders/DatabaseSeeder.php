<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder; // ★ 追記
use Database\Seeders\QuizSeeder;     // ★ 追記

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CategorySeederをQuizSeederより先に実行する
        $this->call([
            CategorySeeder::class, 
            QuizSeeder::class,
        ]);
    }
}