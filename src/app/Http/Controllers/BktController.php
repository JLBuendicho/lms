<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessUpdateMasteryRecords;
use App\Models\BktSkillParams;
use App\Models\MasteryBatchUpdateLog;
use App\Models\MasteryRecords;
use App\Models\QuestionResponse;
use App\Models\Skills;
use App\Models\User;
use App\Services\StudentBktService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BktController extends Controller
{

    protected StudentBktService $studentBktService;

    public function __construct(StudentBktService $studentBktService)
    {
        $this->studentBktService = $studentBktService;
    }

    public function trainBkt()
    {
        $response = Http::get(env('PY_API') . '/train-bkt');

        return response()->json([
            "status" => $response->status(),
            "body" => $response->json(),
        ]);
    }

    public function indexMasteryRecords()
    {
        $response = MasteryRecords::orderBy('updated_at', 'desc')->get();

        return response()->json([
            "status" => 200,
            "body" => $response,
        ]);
    }

    public function initMastery(int $userId)
    {
        $response = Http::get(env('PY_API') . '/mastery-init' . '?userId=' . $userId);

        return response()->json([
            "status" => $response->status(),
            "body" => $response->json(),
        ]);
    }

    public function initMasteries()
    {
        if (!BktSkillParams::exists()) return response()->json(["status" => 500, "body" => "Mastery Initialization failed (BKT not Trained)"]);

        $subjects = BktSkillParams::with('skill.topic.domain.subject')->get()->pluck('skill.topic.domain.subject.id')->filter()->unique()->values()->toArray();

        $students = User::where('role', 'student')->whereRelation('subjects', 'id', $subjects)->get();

        foreach ($students as $student) {
            $this->initMastery($student->id);
        }

        $response = MasteryRecords::orderBy('updated_at', 'desc')->get();
        return response()->json([
            "status" => 200,
            "body" => $response,
        ]);
    }

    public function updateMasteryRecord(int $questionResponseId, bool $isBulkUpdate = false)
    {
        $response = Http::get(env('PY_API') . '/update-mastery-record' . '?questionResponseId=' . $questionResponseId);

        if ($isBulkUpdate) {
            return;
        }

        return response()->json([
            "status" => $response->status(),
            "body" => $response->json(),
        ]);
    }

    public function updateMasteryRecords()
    {
        $runId = MasteryBatchUpdateLog::create([
            "status" => "running",
            "started_at" => now(),
        ])->id;

        ProcessUpdateMasteryRecords::dispatch($runId);

        return response()->json([
            "status" => 200,
            "run_id" => $runId,
            "message" => "Mastery update started",
        ]);
    }

    public function getStudentTopicSkillAttemptCount(int $studentId, int $topicId)
    {
        $topicSkillAttemptCount = $this->studentBktService->getStudentTopicSkillAttemptCount($studentId, $topicId);

        return response()->json([
            "status" => 200,
            "body" => $topicSkillAttemptCount,
        ]);
    }

    public function getStudentTopicMastery(int $studentId, int $topicId)
    {
        $topicMastery = $this->studentBktService->getStudentTopicMastery($studentId, $topicId);

        return response()->json([
            "status" => 200,
            "body" => $topicMastery,
        ]);
    }

    public function getStudentDomainSkillAttemptCount(int $studentId, int $domainId)
    {
        $domainSkillAttemptCount = $this->studentBktService->getStudentDomainSkillAttemptCount($studentId, $domainId);

        return response()->json([
            "status" => 200,
            "body" => $domainSkillAttemptCount,
        ]);
    }

    public function getStudentDomainMastery(int $studentId, int $domainId)
    {
        $domainMastery = $this->studentBktService->getStudentDomainMastery($studentId, $domainId);

        return response()->json([
            "status" => 200,
            "body" => $domainMastery,
        ]);
    }

    public function getStudentSubjectSkillAttemptCount(int $studentId, int $subjectId)
    {
        $subjectSkillAttemptCount = $this->studentBktService->getStudentSubjectSkillAttemptCount($studentId, $subjectId);

        return response()->json([
            "status" => 200,
            "body" => $subjectSkillAttemptCount,
        ]);
    }

    public function getStudentSubjectMastery(int $studentId, int $subjectId)
    {
        $subjectMastery = $this->studentBktService->getStudentSubjectMastery($studentId, $subjectId);

        return response()->json([
            "status" => 200,
            "body" => $subjectMastery,
        ]);
    }
}
