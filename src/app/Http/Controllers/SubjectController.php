<?php

namespace App\Http\Controllers;

use App\Models\Domains;
use App\Models\Subjects;
use App\Models\Topics;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function getStudentSubjectProfileSummary(int $subjectId, int $userId)
    {
        $subject = Subjects::where('id', $subjectId)
            ->whereRelation('users', 'id', $userId)
            ->first();

        $user = User::where('id', $userId)->first();

        $currentUserAssignedSubjects = auth()->user()->subjects->pluck('id')->toArray();
        $userBelongsToInstructor = $user->assignedInstructor->id === auth()->user()->id && in_array($subjectId, $currentUserAssignedSubjects);
        $isCurrentUser = $user->id === auth()->user()->id && in_array($subjectId, $currentUserAssignedSubjects);

        if (!($isCurrentUser || $userBelongsToInstructor)) {
            return view('errors.403');
        }

        $pdf = Pdf::loadView('pages.subjects.student-subject-profile-summary', ['subject' => $subject, 'user' => $user]);

        return $pdf->stream($user->name . '-' . $subject->name . '-profile-sumarry.pdf');
    }

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
