<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 全ユーザーにプロフィールを作成
        foreach (User::all() as $user) {
            Profile::create([
                'user_id' => $user->id,
                'bio' => 'This is a test bio for ' . $user->name,
                'avatar' => 'default.png', // デフォルト画像
            ]);
        }
    }
}
