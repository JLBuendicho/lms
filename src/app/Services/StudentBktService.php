<?php

namespace App\Services;

use App\Models\MasteryRecords;
use App\Models\QuestionResponse;
use App\Models\Skills;

class StudentBktService
{
    public function getStudentTopicSkillAttemptCount(int $studentId, int $topicId)
    {
        $topicSkillAttemptCount = QuestionResponse::where('user_id', $studentId)
            ->whereRelation('skill', 'topic_id', $topicId)
            ->selectRaw('skill_name, COUNT(*) as attempt_count')
            ->groupBy('skill_name')->pluck('attempt_count', 'skill_name')->toArray();

        return $topicSkillAttemptCount;
    }

    public function getStudentTopicMastery(int $studentId, int $topicId)
    {
        $topicSkillWeights = $this->getStudentTopicSkillAttemptCount($studentId, $topicId);
        $topicSkills = Skills::where('topic_id', $topicId)->pluck('name')->toArray();
        $studentSkillMasteries = [];
        foreach ($topicSkills as $skill) {
            $studentSkillMasteries[$skill] = MasteryRecords::where('user_id', $studentId)
                ->where('skill_name', $skill)
                ->value('mastery') ?? 0;
        }
        $totalWeight = array_sum($topicSkillWeights);

        $topicMasteryNumerator = 0;
        foreach ($topicSkills as $skill) {
            $skillWeight = $topicSkillWeights[$skill] ?? 0;
            $skillMastery = $studentSkillMasteries[$skill] ?? 0;
            $topicMasteryNumerator += ($skillWeight * $skillMastery);
        }

        $topicMastery = $totalWeight > 0 ? $topicMasteryNumerator / $totalWeight : 0;

        return $topicMastery;
    }

    public function getStudentDomainSkillAttemptCount(int $studentId, int $domainId)
    {
        $domainSkillAttemptCount = QuestionResponse::where('user_id', $studentId)
            ->whereRelation('skill.topic', 'domain_id', $domainId)
            ->selectRaw('skill_name, COUNT(*) as attempt_count')
            ->groupBy('skill_name')->pluck('attempt_count', 'skill_name')->toArray();

        return $domainSkillAttemptCount;
    }

    public function getStudentDomainMastery(int $studentId, int $domainId)
    {
        $domainSkillWeights = $this->getStudentDomainSkillAttemptCount($studentId, $domainId);
        $domainSkills = Skills::whereRelation('topic', 'domain_id', $domainId)->pluck('name')->toArray();
        $studentSkillMasteries = [];
        foreach ($domainSkills as $skill) {
            $studentSkillMasteries[$skill] = MasteryRecords::where('user_id', $studentId)
                ->where('skill_name', $skill)
                ->value('mastery') ?? 0;
        }
        $totalWeight = array_sum($domainSkillWeights);

        $domainMasteryNumerator = 0;
        foreach ($domainSkills as $skill) {
            $skillWeight = $domainSkillWeights[$skill] ?? 0;
            $skillMastery = $studentSkillMasteries[$skill] ?? 0;
            $domainMasteryNumerator += ($skillWeight * $skillMastery);
        }

        $domainMastery = $totalWeight > 0 ? $domainMasteryNumerator / $totalWeight : 0;

        return $domainMastery;
    }

    public function getStudentSubjectSkillAttemptCount(int $studentId, int $subjectId)
    {
        $subjectSkillAttemptCount = QuestionResponse::where('user_id', $studentId)
            ->whereRelation('skill.topic.domain', 'subject_id', $subjectId)
            ->selectRaw('skill_name, COUNT(*) as attempt_count')
            ->groupBy('skill_name')->pluck('attempt_count', 'skill_name')->toArray();

        return $subjectSkillAttemptCount;
    }

    public function getStudentSubjectMastery(int $studentId, int $subjectId)
    {
        $subjectSkillWeights = $this->getStudentSubjectSkillAttemptCount($studentId, $subjectId);
        $subjectSkills = Skills::whereRelation('topic.domain', 'subject_id', $subjectId)->pluck('name')->toArray();
        $studentSkillMasteries = [];
        foreach ($subjectSkills as $skill) {
            $studentSkillMasteries[$skill] = MasteryRecords::where('user_id', $studentId)
                ->where('skill_name', $skill)
                ->value('mastery') ?? 0;
        }
        $totalWeight = array_sum($subjectSkillWeights);

        $subjectMasteryNumerator = 0;
        foreach ($subjectSkills as $skill) {
            $skillWeight = $subjectSkillWeights[$skill] ?? 0;
            $skillMastery = $studentSkillMasteries[$skill] ?? 0;
            $subjectMasteryNumerator += ($skillWeight * $skillMastery);
        }

        $subjectMastery = $totalWeight > 0 ? $subjectMasteryNumerator / $totalWeight : 0;

        return $subjectMastery;
    }
}
