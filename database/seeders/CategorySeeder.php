<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 外部キー制約を一時的に無効化
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // 既存データをクリアしてから再登録 (truncate)
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            ['name' => '地理・歴史', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '科学・自然', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '雑学・趣味', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        // 外部キー制約を元に戻す
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}