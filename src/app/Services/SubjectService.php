<?php

namespace App\Services;

use App\Models\User;;

use App\Models\Domains;
use App\Models\LearningMaterial;
use App\Models\MasteryRecords;
use App\Models\Questions;
use App\Models\Skills;
use App\Models\Topics;

class SubjectService
{
    public function getStudentSubjects(int $studentId)
    {
        $user = User::find($studentId);
        if (!$user) {
            return [];
        }

        return $user->subjects()->with('domains.topics.skills')
            ->get();
    }

    public function getSubjectDomains(int $subjectId)
    {
        return Domains::where('subject_id', $subjectId)->get();
    }

    public function getDomainTopics(int $domainId)
    {
        return Topics::where('domain_id', $domainId)->get();
    }

    public function getTopicSkills(int $topicId)
    {
        return Skills::where('topic_id', $topicId)->get();
    }

    public function userSkillMasteryRecordExists(int $userId, int $skillId)
    {
        $userSkillMasteryRecord = MasteryRecords::where('user_id', $userId)->where('skill_id', $skillId)->first();

        if (!$userSkillMasteryRecord) {
            return false;
        }

        return true;
    }

    public function skillResourceMaterialsExists(int $skillId)
    {
        $exists = LearningMaterial::where('material_type', 'resource')
            ->where('is_active', true)
            ->where('skill_id', $skillId)
            ->exists();

        return $exists;
    }

    public function skillFlashcardMaterialsExists(int $skillId)
    {
        $exists = LearningMaterial::where('material_type', 'flash_card')
            ->where('is_active', true)
            ->where('skill_id', $skillId)
            ->exists();

        return $exists;
    }

    public function skillQuestionMaterialsExists(int $skillId)
    {
        $exists = Questions::where('is_active', true)
            ->where('skill_id', $skillId)
            ->exists();

        return $exists;
    }

    public function subjectAssessmentMaterialsExists(int $subjectId, string $assessmentType)
    {
        $exists = Questions::where('is_active', true)
            ->where('assessment_type', $assessmentType)
            ->where('subject_id', $subjectId)
            ->exists();

        return $exists;
    }

    public function studentSubjectAssessmentResponseExists(int $studentId, int $subjectId, string $assessmentType)
    {
        $exists = true;

        if (Questions::where('is_active', true)
            ->where('assessment_type', $assessmentType)
            ->where('subject_id', $subjectId)
            ->exists()
        ) {
            $exists = Questions::where('is_active', true)
                ->where('assessment_type', $assessmentType)
                ->where('subject_id', $subjectId)
                ->whereHas('questionResponses', function ($query) use ($studentId) {
                    $query->where('user_id', $studentId);
                })
                ->exists();
        }

        return $exists;
    }
}
