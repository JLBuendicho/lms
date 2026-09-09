<?php

namespace App\Http\Controllers;

use App\Models\Domains;
use App\Models\Subjects;
use App\Models\Topics;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function getStudentSubjectPage(int $subjectId)
    {
        $studentSubject = Subjects::where('id', $subjectId)
            ->whereRelation('users', 'id', auth()->user()->id)
            ->first();

        if (!$studentSubject) {
            return view('errors.403');
        }

        return view('pages.subjects.subject-page', ['subject' => $studentSubject]);
    }

    public function getStudentSubjectDomainPage(int $subjectId, int $domainId)
    {
        $studentSubject = Subjects::where('id', $subjectId)
            ->whereRelation('users', 'id', auth()->user()->id)
            ->first();

        if (!$studentSubject) {
            return view("403");
        }

        $studentSubjectDomain = Domains::where('id', $domainId)
            ->whereRelation('subject', 'id', $studentSubject->id)
            ->with('subject')
            ->first();

        return view("pages.subjects.domain-page", ['subject' => $studentSubject, 'domain' => $studentSubjectDomain]);
    }

    public function getStudentSubjectTopicPage(int $subjectId, int $topicId)
    {
        $studentSubject = Subjects::where('id', $subjectId)
            ->whereRelation('users', 'id', auth()->user()->id)
            ->first();

        if (!$studentSubject) {
            return view("403");
        }

        $studentSubjectTopic = Topics::where('id', $topicId)
            ->whereRelation('domain.subject', 'id', $studentSubject->id)
            ->with('domain.subject')
            ->first();


        return view("pages.subjects.topic-page", ['subject' => $studentSubject, 'topic' => $studentSubjectTopic]);
    }
}
