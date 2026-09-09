<?php

namespace App\Services;

use App\Models\User;;
use App\Models\Domains;
use App\Models\Skills;
use App\Models\Topics;

class SubjectService
{
    public function getStudentSubjects(int $studentId) {
        $user = User::find($studentId);
        if (!$user) {
            return [];
        }

        return $user->subjects;
    }

    public function getSubjectDomains(int $subjectId) {
        return Domains::where('subject_id', $subjectId)->get();
    }

    public function getDomainTopics(int $domainId) {
        return Topics::where('domain_id', $domainId)->get();
    }

    public function getTopicSkills(int $topicId) {
        return Skills::where('topic_id', $topicId)->get();
    }
}