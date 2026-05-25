<?php

namespace App\Http\Controllers;

use App\Models\QuestionResponse;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function startAssessment(string $subjectName, string $assessmentType)
    {
        if (QuestionResponse::where('user_id', Auth::id())
            ->where('assessment_type', $assessmentType)
            ->whereRelation('question', function ($query) use ($subjectName) {
                $query->whereRelation('subject', 'name', $subjectName);
            })->exists()
        ) {
            return redirect()->route('assessment.results', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType]);
        }

        session()->forget("{$subjectName}.{$assessmentType}.assessment");

        $questions = Questions::whereRelation('subject', 'name', $subjectName)
            ->where('assessment_type', $assessmentType)
            ->get();

        $shuffledQuestionIds = $questions->pluck('id')->shuffle()->toArray();

        session([
            "{$subjectName}.{$assessmentType}.assessment.questions" => $shuffledQuestionIds,
            "{$subjectName}.{$assessmentType}.assessment.answers" => [],
        ]);

        return redirect()->route('assessment.question.show', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType, 'step' => 1]);
    }

    public function showQuestion(string $subjectName, string $assessmentType, int $step)
    {
        if (QuestionResponse::where('user_id', Auth::id())
            ->where('assessment_type', $assessmentType)
            ->whereRelation('question', function ($query) use ($subjectName) {
                $query->whereRelation('subject', 'name', $subjectName);
            })->exists()
        ) {
            return redirect()->route('assessment.results', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType]);
        }

        $order = session("{$subjectName}.{$assessmentType}.assessment.questions");

        if (!$order) {
            return redirect()->route('assessment.start', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType]);
        }

        $totalQuestions = count($order);
        abort_if($step < 1 || $step > $totalQuestions, 404);

        $questionId = $order[$step - 1];
        $question = Questions::findOrFail($questionId);
        $answers = session("{$subjectName}.{$assessmentType}.assessment.answers", []);

        return view('assessment', compact('subjectName', 'assessmentType', 'question', 'step', 'totalQuestions', 'answers'));
    }

    public function storeQuestionResponse(Request $request, string $subjectName, string $assessmentType, int $step)
    {
        $order = session("{$subjectName}.{$assessmentType}.assessment.questions");

        if (!$order) {
            return redirect()->route('assessment.start', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType]);
        }

        $totalQuestions = count($order);
        abort_if($step < 1 || $step > $totalQuestions, 404);

        $questionId = $order[$step - 1];

        $validatedData = $request->validate([
            'answer' => 'required|string',
        ]);
        $answer = $validatedData['answer'];

        $answers = session("{$subjectName}.{$assessmentType}.assessment.answers", []);
        $answers[$questionId] = $answer;
        session(["{$subjectName}.{$assessmentType}.assessment.answers" => $answers]);

        $nextStep = $step + 1;

        if ($nextStep <= $totalQuestions) {
            return redirect()->route('assessment.question.show', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType, 'step' => $nextStep]);
        }
    }

    public function assessmentResults(string $subjectName, string $assessmentType)
    {
        $responses = QuestionResponse::where('user_id', Auth::id())
            ->where('assessment_type', $assessmentType)
            ->whereRelation('question', function ($query) use ($subjectName) {
                $query->whereRelation('subject', 'name', $subjectName);
            })->with('question')->get();

        if ($responses) {
            return view('assessment-results', compact('subjectName', 'assessmentType', 'responses'));
        }


        $order = session("{$subjectName}.{$assessmentType}.assessment.questions", []);
        $answers = session("{$subjectName}.{$assessmentType}.assessment.answers", []);

        if (!$order || !$answers) {
            return redirect()->route('assessment.start', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType]);
        }

        foreach ($order as $questionId) {
            $question = Questions::find($questionId);

            if (isset($question->answer)) {
                $answerIsCorrect = strcasecmp(trim($answers[$questionId]), trim($question->answer)) === 0;
            } else {
                $answerIsCorrect = true;
            }

            $lastOrderId = QuestionResponse::where('user_id', Auth::id())
                ->where('skill_id', $question->skill_id)
                ->max('order_id') ?? 0;

            QuestionResponse::create([
                'question_id' => $question->id,
                'user_id' => Auth::id(),
                'skill_id' => $question->skill_id,
                'skill_name' => $question->skill->name,
                'correct' => $answerIsCorrect,
                'order_id' => $lastOrderId + 1,
                'mastery_is_recorded' => false,
            ]);
        }

        return view('assessment-results', compact('subjectName', 'assessmentType', 'responses'));
    }
}
