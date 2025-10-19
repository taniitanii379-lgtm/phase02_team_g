<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;
use App\Models\Badge;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // テストユーザーを作成
        User::factory()->create([
                'name' => '名無し', // 名前は自由
                'email' => 'test@example.com',
                'bio' => null, // 最初は自己紹介も空
            ])->each(function ($user) {
            Profile::create([
                'user_id' => $user->id,
                'bio' => 'This is a test bio for ' . $user->name,
                'avatar' => 'default.png', 
                'level' => 1,
                'level_progress' => 0,
                'total_plays' => 0,
                'accuracy' => 0,
                'total_score' => 0,
                'favorite_genre' => null,
                'weakest_genre' => null,
            ]);
            $badges = Badge::find([1, 2]); // ID 1と2のバッジを取得
            $user->badges()->attach($badges);
        
        });
    }
}
