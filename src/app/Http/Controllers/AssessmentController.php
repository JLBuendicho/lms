<?php

namespace App\Http\Controllers;

use App\Models\QuestionResponse;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        $questionIds = $questions->sortBy('id')->pluck('id')->toArray();

        session([
            "{$subjectName}.{$assessmentType}.assessment.questions" => $questionIds,
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

        // $validatedData = $request->validate([
        //     'answer' => 'required|array',
        //     'answer.value' => 'required|string',
        // ]);
        // $answer = $validatedData['answer'];
        $validatedData = $request->validate([
            'answer' => 'required|array',
            'answer.value' => 'required|array',
            'answer.value.*' => 'required|string',
        ]);
        $answer = $validatedData['answer']; // ['value' => ['this is an answer']]

        $answers = session("{$subjectName}.{$assessmentType}.assessment.answers", []);
        $answers[$questionId] = $answer;
        session(["{$subjectName}.{$assessmentType}.assessment.answers" => $answers]);

        $nextStep = $step + 1;

        if ($nextStep <= $totalQuestions) {
            return redirect()->route('assessment.question.show', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType, 'step' => $nextStep]);
        }

        return redirect()->route('assessment.results', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType]);
    }

    public function assessmentResults(string $subjectName, string $assessmentType)
    {
        $responses = QuestionResponse::where('user_id', Auth::id())
            ->where('assessment_type', $assessmentType)
            ->whereRelation('question', function ($query) use ($subjectName) {
                $query->whereRelation('subject', 'name', $subjectName);
            })->with('question')->get();


        if (!$responses->isEmpty()) {
            return view('assessment-results', compact('subjectName', 'assessmentType', 'responses'));
        }


        $order = session("{$subjectName}.{$assessmentType}.assessment.questions", []);
        $answers = session("{$subjectName}.{$assessmentType}.assessment.answers", []);

        if (!$order || !$answers || count($order) != count($answers)) {
            return redirect()->route('assessment.start', ['subjectName' => $subjectName, 'assessmentType' => $assessmentType]);
        }

        foreach ($order as $questionId) {
            $question = Questions::find($questionId);
            $response = $answers[$questionId]['value']; // always an array now

            // if (isset($question->answer)) {
            //     $answerIsCorrect = strcasecmp(trim($answers[$questionId]), trim($question->answer)) === 0;
            // } else {
            //     $answerIsCorrect = true;
            // }

            if (isset($question->answers)) {
                if (in_array($question->question_type, ['multiple_choice', 'multiple_choice_math'])) {
                    $normalize = fn($values) => collect($values)
                        ->map(fn($v) => strtolower(trim($v)))
                        ->sort()
                        ->values()
                        ->all();

                    $correctChoices = is_array($question->answers)
                        ? $question->answers
                        : array_map('trim', explode(',', $question->answers));

                    $answerIsCorrect = $normalize($response) === $normalize($correctChoices);
                    // Log::info('Multiple choice answer check', [
                    //     'response' => $response,
                    //     'correctChoices' => $correctChoices,
                    //     'normalizedResponse' => $normalize($response),
                    //     'normalizedCorrectChoices' => $normalize($correctChoices),
                    //     'isCorrect' => $answerIsCorrect,
                    // ]);
                } else {
                    $answerIsCorrect = strcasecmp(trim($response[0] ?? ''), trim($question->answers[0])) === 0;
                    // Log::info('Single answer check', [
                    //     'response' => trim($response[0] ?? ''),
                    //     'correctAnswer' => trim($question->answers[0]),
                    //     'isCorrect' => $answerIsCorrect,
                    // ]);
                }
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
                'response' => $response,
                'correct' => $answerIsCorrect,
                'order_id' => $lastOrderId + 1,
                'assessment_type' => $assessmentType,
                'is_validated' => false,
                'mastery_is_recorded' => false,
            ]);
        }

        return view('assessment-results', compact('subjectName', 'assessmentType', 'responses'));
    }
}
