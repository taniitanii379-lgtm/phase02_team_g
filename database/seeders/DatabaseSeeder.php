<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 必要なSeederのみ呼び出す
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            QuizSeeder::class,
            BadgeSeeder::class,
            ProfileSeeder::class,
            // CategorySeeder::class, // 不要なのでコメントアウト
        ]);
    }
}
