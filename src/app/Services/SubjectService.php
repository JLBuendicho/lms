<?php

namespace App\Services;

use App\Models\User;;

use App\Models\Domains;
use App\Models\MasteryRecords;
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
}
