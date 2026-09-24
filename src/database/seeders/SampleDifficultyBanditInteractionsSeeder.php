<?php

namespace Database\Seeders;

use App\Models\BktSkillParams;
use App\Models\DifficultyBanditInteractions;
use App\Models\MasteryRecords;
use App\Models\Questions;
use App\Models\User;
use Illuminate\Database\Seeder;
use Random\Randomizer;

class SampleDifficultyBanditInteractionsSeeder extends Seeder
{
    public function run(): void
    {
        $interactionCount = 300;
        for ($i = 0; $i < $interactionCount; $i++) {
            $studentId = User::where('role', 'student')->inRandomOrder()->value('id');

            $question = Questions::whereNotNull('answers')->inRandomOrder()->first();
            $skillId = $question->skill_id;
            $questionId = $question->id;

            $arms = ['easy', 'hard'];
            $arm = $arms[rand(0, count($arms) - 1)];
            $selectionSource = 'random';

            $latestInteraction = DifficultyBanditInteractions::where('student_id', $studentId)->latest()->first();
            $latestSkillInteraction = DifficultyBanditInteractions::where('student_id', $studentId)->where('skill_id', $skillId)->latest()->first();
            if ($latestSkillInteraction) {
                $previousMastery = $latestInteraction->previous_mastery;
                $nAttemptsThisSkill = $latestSkillInteraction->context['n_attempts_this_skill'] + 1;
            } else {
                $previousMastery = MasteryRecords::where('user_id', $studentId)->where('skill_id', $skillId)->value('mastery');
                $nAttemptsThisSkill = 0;
            }

            $skillLearnRate = BktSkillParams::where('skill_id', $skillId)->value('prior');
            $recentCorrectnessRate = 0.5;
            $hoursSinceLastPractice = $latestInteraction ? 0.25 : 999.0;

            $isCorrect = rand(0, 1);

            $randomizer = new Randomizer();
            if ($isCorrect) {
                $minReward = 0.01;
                $maxReward = min(0.10, 1.0 - $previousMastery);

                if ($maxReward >= $minReward) {
                    $reward = $randomizer->getFloat($minReward, $maxReward);
                } else {
                    $reward = 0.0;
                }
            } else {
                $minReward = -0.10;
                $maxReward = -0.01;

                $minReward = max($minReward, -$previousMastery);

                if ($maxReward >= $minReward) {
                    $reward = $randomizer->getFloat($minReward, $maxReward);
                } else {
                    $reward = 0.0;
                }
            }
            // $reward = $randomizer->getFloat(
            //     $isCorrect ?
            //         ($previousMastery - 0.01 > 0 ?
            //             -0.01 :
            //             0.01
            //         ) : ($previousMastery - 0.10 > 0 ?
            //             -0.10 :
            //             0.1
            //         ),
            //     $isCorrect ?
            //         ($previousMastery + 0.10 < 1.0 ?
            //             0.10 : (1.0 - $previousMastery) - 0.1
            //         ) : ($previousMastery + 0.5 < 1.0 ?
            //             0.5 : (1.0 - $previousMastery) - 0.1
            //         )
            // );

            $newMastery = $previousMastery + $reward;

            DifficultyBanditInteractions::create([
                'student_id' => $studentId,
                'skill_id' => $skillId,
                'question_id' => $questionId,
                'arm' => $arm,
                'selection_source' => $selectionSource,
                'context' => [
                    'p_mastery' => $previousMastery,
                    'skill_learn_rate' => $skillLearnRate,
                    'n_attempts_this_skill' => $nAttemptsThisSkill,
                    'recent_correctness_rate' => $recentCorrectnessRate,
                    'hours_since_last_practice' => $hoursSinceLastPractice,
                ],
                'previous_mastery' => $previousMastery,
                'is_correct' => $isCorrect,
                'new_mastery' => $newMastery,
                'reward' => $reward,
            ]);
        }
    }
}
