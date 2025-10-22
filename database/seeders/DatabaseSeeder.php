<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder; // ★ 追記
use Database\Seeders\QuizSeeder;     // ★ 追記
use Database\Seeders\UserSeeder;     // ★ 追記
use Database\Seeders\ProfileSeeder;     // ★ 追記
use Database\Seeders\ScoreSeeder;     // ★ 追記


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class, 
            QuizSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            BadgeSeeder::class,
            ScoreSeeder::class,
        ]);
    }
}