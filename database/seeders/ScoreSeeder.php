<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Score;

class ScoreSeeder extends Seeder
{
    public function run(): void
    {
        Score::insert([
            ['user_id' => 1, 'score' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'score' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'score' => 70, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
