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
        foreach (User::all() as $user) {
            Profile::create([
                'user_id' => $user->id,
                'bio' => 'This is a test bio for ' . $user->name,
                'avatar' => 'default.png', 
                'level' => 18,
                'level_progress' => 75,
                'total_plays' => 256,
                'accuracy' => 88,
                'total_score' => 125480,
                'favorite_genre' => '歴史',
                'weakest_genre' => '科学',
            ]);
            $badges = Badge::find([1, 2]); // ID 1と2のバッジを取得
            $user->badges()->attach($badges);
        }
    }
}
