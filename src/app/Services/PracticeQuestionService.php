<?php

namespace App\Services;

use App\Models\GradeLvls;
use App\Models\Questions;

class PracticeQuestionService
{
    public function getSkillQuestionGradeLvls(int $skillId) {
        $skillQuestions = Questions::whereNotNull('answers')
            ->where('skill_id', $skillId)
            ->select('grade_lvl_id')
            ->distinct()
            ->with('gradeLvl')->orderBy(
                GradeLvls::select('grade_lvl')
                    ->whereColumn('grade_lvls.id', 'questions.grade_lvl_id'),
                'asc'
            )->get();

        $skillQuestionGradeLvls = $skillQuestions->pluck('gradeLvl.grade_lvl')->toArray();

        return $skillQuestionGradeLvls;
    }

    public function selectSkillQuestionGradeLvl(array $skillQuestionGradeLvls, $difficulty) {
        $lvlsLen = count($skillQuestionGradeLvls);

        if (count($skillQuestionGradeLvls) === 1) {
            $selectedQuestionLvl = $skillQuestionGradeLvls[0];
        } elseif (count($skillQuestionGradeLvls) === 2) {
            $selectedQuestionLvl = $difficulty === 'easy' ? $skillQuestionGradeLvls[0] : $skillQuestionGradeLvls[1];
        } else {
            $slicedLvlArray = $difficulty === 'easy' ? 
                array_slice($skillQuestionGradeLvls, 0, floor($lvlsLen / 2) + 1) :
                array_slice($skillQuestionGradeLvls, floor($lvlsLen / 2));

            $selectedQuestionLvl = $slicedLvlArray[array_rand($slicedLvlArray)];
        }

        return $selectedQuestionLvl;
    }

    public function getSkillQuestionBasedOnDifficulty(int $skillId, string $difficulty)
    {
        $skillQuestionGradeLvls = $this->getSkillQuestionGradeLvls($skillId);
        if (empty($skillQuestionGradeLvls)) {
            return null;
        }

        $selectedQuestionLvl = $this->selectSkillQuestionGradeLvl($skillQuestionGradeLvls, $difficulty);

        $gradeLvlId = GradeLvls::where('grade_lvl', $selectedQuestionLvl)->value('id');

        $selectedQuestion = Questions::whereNotNull('answers')
            ->where('skill_id', $skillId)
            ->where('grade_lvl_id', $gradeLvlId)
            ->inRandomOrder()->first();

        return $selectedQuestion;
    }
}