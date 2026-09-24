<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DifficultyBanditInteractionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('difficulty_bandit_interactions')->insert([
            [
                'id' => 1,
                'student_id' => 7,
                'skill_id' => 1,
                'question_id' => 1,
                'arm' => 'hard',
                'selection_source' => 'random',
                'context' => json_encode([
    'p_mastery' => 0.8484049142971,
    'skill_learn_rate' => 0.6,
    'n_attempts_this_skill' => 0,
    'recent_correctness_rate' => 0.5,
    'hours_since_last_practice' => 999
]),
                'previous_mastery' => '0.84840',
                'is_correct' => 0,
                'new_mastery' => '0.91794',
                'reward' => '0.06954',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'student_id' => 7,
                'skill_id' => 1,
                'question_id' => 1,
                'arm' => 'easy',
                'selection_source' => 'random',
                'context' => json_encode([
    'p_mastery' => 0.9179405335298,
    'skill_learn_rate' => 0.6,
    'n_attempts_this_skill' => 1,
    'recent_correctness_rate' => 0,
    'hours_since_last_practice' => 999
]),
                'previous_mastery' => '0.91794',
                'is_correct' => 1,
                'new_mastery' => '0.97847',
                'reward' => '0.06053',
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
}