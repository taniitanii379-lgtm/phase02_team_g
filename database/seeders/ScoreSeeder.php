<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Score;

class ScoreSeeder extends Seeder
{
    public function run(): void
    {
        Score::insert([
            ['quiz_id' => 1,'user_id' => 1, 'score' => 80, 'total_questions'=>3,'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 1,'user_id' => 2, 'score' => 90, 'total_questions'=>4,'created_at' => now(), 'updated_at' => now()],
            ['quiz_id' => 1,'user_id' => 3, 'score' => 70, 'total_questions'=>5,'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
