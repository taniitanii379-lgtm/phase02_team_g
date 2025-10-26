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
            ['name' => 'はじめの一歩', 'icon' => '🔰', 'description' => '初めてクイズをプレイした'],
            ['name' => 'クイズデビュー', 'icon' => '🎓', 'description' => 'クイズに10回プレイした'],
            ['name' => '百戦錬磨', 'icon' => '🛡️', 'description' => 'クイズに100回プレイした'],
            ['name' => '安定の天才', 'icon' => '🧩', 'description' => '正答率90%以上をキープ'],
            ['name' => '高得点者', 'icon' => '🏆', 'description' => '累計スコア1万点達成'],
        ]);
    }
}
