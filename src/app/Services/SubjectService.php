<?php

namespace App\Services;

use App\Models\Domains;
use App\Models\Topics;

class SubjectService
{
    public function getSubjectDomains(int $subjectId) {
        return Domains::where('subject_id', $subjectId)->get();
    }

    public function getDomainTopics(int $domainId) {
        return Topics::where('domain_id', $domainId)->get();
    }
}