<?php

namespace App\Http\Controllers;

use App\Models\MasteryRecords;
use App\Models\QuestionResponse;
use App\Models\Questions;
use App\Models\Skills;
use App\Services\PracticeQuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class QuestionController extends Controller
{
    protected PracticeQuestionService $practiceQuestionService;

    public function __construct(PracticeQuestionService $practiceQuestionService)
    {
        $this->practiceQuestionService = $practiceQuestionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Questions $questions)
    {
        //
    }

    public function getPracticeQuestion(int $skillId)
    {
        session()->forget('practice-question');

        $skill = Skills::where('id', $skillId)
            ->with('topic.domain.subject')
            ->first();

        $difficultyBanditResponse = Http::post(env('PY_API') . '/difficulty-bandit/select', [
            'student_id' => auth()->user()->id,
            'skill_id' => $skillId,
        ])->json();

        $arm = $difficultyBanditResponse['arm'];
        $selectionSource = $difficultyBanditResponse['selection_source'];
        $context = $difficultyBanditResponse['context'];

        $selectedQuestion = $this->practiceQuestionService->getSkillQuestionBasedOnDifficulty($skillId, $arm);

        if ($selectedQuestion == null) {
            return view('errors.404');
        }

        $questionType = $selectedQuestion->question_type;
        $questionText = $selectedQuestion->question;
        $questionChoices = $selectedQuestion->choices;
        $attachments = $selectedQuestion->attachments;
        $attachmentFileNames = $selectedQuestion->attachment_file_names;

        // dd($selectedQuestion);

        session([
            'practice-question.arm' => $arm,
            'practice-question.selection-source' => $selectionSource,
            'practice-question.context' => $context,
            'practice-question.selected-question' => $selectedQuestion,
            'practice-question.skill' => $skill,
        ]);

        return view('practice-question', compact('skill', 'questionType', 'questionText', 'questionChoices', 'attachments', 'attachmentFileNames'));
    }

    public function evaluatePracticeQuestionResponse(Request $request)
    {
        $arm = session('practice-question.arm');
        $selectionSource = session('practice-question.selection-source');
        $context = session('practice-question.context');
        $question = session('practice-question.selected-question');

        if (!$arm || !$selectionSource || !$context || !$question) {
            return redirect()->back()->with('error');
        }

        $validatedData = $request->validate([
            'answer' => 'required|array'
        ]);
        $response = $validatedData['answer'];

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
        } else {
            $answerIsCorrect = strcasecmp(trim($response[0] ?? ''), trim($question->answers[0])) === 0;
        }

        $lastOrderId = QuestionResponse::where('user_id', Auth::id())
            ->where('skill_id', $question->skill_id)
            ->max('order_id') ?? 0;

        $questionResponse = QuestionResponse::create([
            'question_id' => $question->id,
            'user_id' => Auth::id(),
            'skill_id' => $question->skill_id,
            'skill_name' => $question->skill->name,
            'response' => $response,
            'correct' => $answerIsCorrect,
            'order_id' => $lastOrderId + 1,
            'assessment_type' => 'practice',
            'is_validated' => true,
            'mastery_is_recorded' => false,
        ]);

        Http::get(env('PY_API') . '/mastery-records/update-mastery-record' . '?questionResponseId=' . $questionResponse->id);
        $newMastery = MasteryRecords::where('user_id', Auth::id())->where('skill_id', $question->skill_id)->first()->value('mastery');

        $banditOutcomeResponse = Http::post(env('PY_API') . '/difficulty-bandit/outcome', [
            'student_id' => Auth::id(),
            'skill_id' => $question->skill_id,
            'question_id' => $question->id,
            'arm' => $arm,
            'selection_source' => $selectionSource,
            'context' => $context,
            'previous_mastery' => $context['p_mastery'],
            'is_correct' => $answerIsCorrect,
            'new_mastery' => $newMastery,
        ]);

        $reward = $banditOutcomeResponse->json('reward');
        session([
            'practice-question.answer-is-correct' => $answerIsCorrect,
            'practice-question.new-mastery' => $newMastery,
            'practice-question.reward' => $reward,
        ]);

        return redirect()->route('questions.practice.result');
    }

    public function showPracticeQuestionResult()
    {
        if (!session('practice-question')) {
            return redirect()->route('dashboard');
        }

        $context = session('practice-question.context');
        $question = session('practice-question.selected-question');
        $skill = session('practice-question.skill');
        $isCorrect = session('practice-question.answer-is-correct');
        $newMastery = session('practice-question.new-mastery');
        $reward = session('practice-question.reward');

        session()->forget('practice-question');

        return view('practice-question-result', ['question' => $question, 'skill' => $skill, 'isCorrect' => $isCorrect, 'pMastery' => $context['p_mastery'], 'nMastery' => $newMastery, 'reward' => $reward]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Questions $questions)
    {
        //
    }
}
