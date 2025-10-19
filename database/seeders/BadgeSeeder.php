<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('badges')->insert([
            ['name' => 'ビギナー', 'icon' => '🔰', 'description' => 'クイズを10回プレイした'],
            ['name' => '百戦錬磨', 'icon' => '🛡️', 'description' => 'クイズを100回プレイした'],
            ['name' => '高得点者', 'icon' => '🏆', 'description' => '累計スコア10万点達成'],
        ]);
    }
}
