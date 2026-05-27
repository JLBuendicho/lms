<?php

namespace Database\Seeders;

use App\Models\QuestionResponse;
use App\Models\Questions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RmaResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'student')->get();
        $questions = Questions::with([
            'skill',
        ])->get();

        foreach ($students as $student) {
            foreach ($questions as $question) {
                $latestSkillResponseRecord = QuestionResponse::where('user_id', $student->id)
                    ->where('skill_id', $question->skill->id)
                    ->orderByDesc('order_id')->first();
                $orderId = $latestSkillResponseRecord != null ? $latestSkillResponseRecord->order_id + 1 : 1;

                $correct = (bool)random_int(0, 1);
                $response = ($question->answer !== null && $correct)
                    ? $question->answer
                    : '$\text{for testing purposes, imagine this is an answer to the question}$';

                QuestionResponse::create([
                    'question_id' => $question->id,
                    'user_id' => $student->id,
                    'skill_id' => $question->skill->id,
                    'skill_name' => $question->skill->name,
                    'response' => $response,
                    'correct' => $correct,
                    'order_id' => $orderId,
                    'assessment_type' => 'initial',
                    'is_validated' => true,
                ]);
            }
        }
    }
}
