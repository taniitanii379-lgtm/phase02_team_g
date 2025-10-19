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
            ['name' => '初級クイズマスター', 'icon' => '🎓', 'description' => '初めてクイズに正解した'],
            ['name' => '歴史探求者', 'icon' => '📜', 'description' => '歴史クイズを50回プレイした'],
            ['name' => 'スピードスター', 'icon' => '⚡️', 'description' => '平均回答時間5秒以内を達成'],
            ['name' => '百戦錬磨', 'icon' => '🛡️', 'description' => '100回クイズをプレイした'],
        ]);
    }
}
