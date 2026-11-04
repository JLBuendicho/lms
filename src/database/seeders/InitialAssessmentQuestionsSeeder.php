<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialAssessmentQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 1,
                'question_type' => 'identification_math',
                'question' => 'Evaluate the expression 8 + 6 × 2 − 4. Show your computation.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 8+12-4=16 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 1,
                'question_type' => 'multiple_choice_math',
                'question' => 'Evaluate 3 × (4 + 5)² ÷ 9.',
                'choices' => json_encode([
                    '$ \\text{a. }27 $',
                    '$ \\text{b. }81 $',
                    '$ \\text{c. }9 $',
                    '$ \\text{d. }243 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }27 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 1,
                'question_type' => 'identification_math',
                'question' => 'Evaluate 2³ + 4 × (10 − 6)² ÷ 8. Show your computation.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 8+4\\times16\\div8=8+8=16 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 1,
                'question_type' => 'multiple_choice_math',
                'question' => 'Evaluate 5 + 2[3² − (8 − 5)] ÷ 4.',
                'choices' => json_encode([
                    '$ \\text{a. }8 $',
                    '$ \\text{b. }11 $',
                    '$ \\text{c. }17 $',
                    '$ \\text{d. }20 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }8 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 2,
                'question_type' => 'identification_math',
                'question' => 'Study the number expressions: 3 × 3 − 2 × 4 = 1, 4 × 4 − 3 × 5 = 1, 5 × 5 − 4 × 6 = 1. Write the next number expression in the pattern.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 6\\times6-5\\times7=1 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 2,
                'question_type' => 'multiple_choice_math',
                'question' => 'The sums 1 + 3 = 4, 1 + 3 + 5 = 9, and 1 + 3 + 5 + 7 = 16 follow a pattern. Which expression gives the sum of the first n odd numbers?',
                'choices' => json_encode([
                    '$ \\text{a. }n^2 $',
                    '$ \\text{b. }2n $',
                    '$ \\text{c. }n+1 $',
                    '$ \\text{d. }2n-1 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }n^2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 2,
                'question_type' => 'identification_math',
                'question' => 'Write an expression for the nth term of the sequence 5, 8, 11, 14, …',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3n+2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 2,
                'question_type' => 'multiple_choice_math',
                'question' => 'Which expression gives the nth term of the sequence 2, 6, 12, 20, 30, …?',
                'choices' => json_encode([
                    '$ \\text{a. }n\\left(n+1\\right) $',
                    '$ \\text{b. }n^2+2 $',
                    '$ \\text{c. }4n-2 $',
                    '$ \\text{d. }n^2+n+1 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }n\\left(n+1\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 3,
                'question_type' => 'identification_math',
                'question' => 'Evaluate 2⁵. Show your computation.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 2^5=2\\times2\\times2\\times2\\times2=32 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 3,
                'question_type' => 'multiple_choice_math',
                'question' => 'Simplify x³ · x⁴.',
                'choices' => json_encode([
                    '$ \\text{a. }x^7 $',
                    '$ \\text{b. }x^{12} $',
                    '$ \\text{c. }2x^7 $',
                    '$ \\text{d. }x^{-1} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }x^7 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 3,
                'question_type' => 'identification_math',
                'question' => 'Simplify (2x³)² ÷ x⁴.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{4x^6}{x^4}=4x^2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 3,
                'question_type' => 'multiple_choice_math',
                'question' => 'Simplify (3a²b)³ ÷ (9a⁴b).',
                'choices' => json_encode([
                    '$ \\text{a. }3a^2b^2 $',
                    '$ \\text{b. }3a^2b $',
                    '$ \\text{c. }27a^2b^2 $',
                    '$ \\text{d. }3a^{10}b^2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }3a^2b^2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 4,
                'question_type' => 'identification_math',
                'question' => 'Find the sum of 3.45 and 2.8.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3.45+2.8=6.25 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 4,
                'question_type' => 'multiple_choice_math',
                'question' => 'What is 12.6 × 0.5?',
                'choices' => json_encode([
                    '$ \\text{a. }6.3 $',
                    '$ \\text{b. }63 $',
                    '$ \\text{c. }0.63 $',
                    '$ \\text{d. }25.2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }6.3 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 4,
                'question_type' => 'identification_math',
                'question' => 'Divide 7.2 by 0.08.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 7.2\\div0.08=90 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 4,
                'question_type' => 'multiple_choice_math',
                'question' => 'Evaluate 0.3 × 0.4 + 1.2 ÷ 0.6 − 0.05.',
                'choices' => json_encode([
                    '$ \\text{a. }2.07 $',
                    '$ \\text{b. }2.17 $',
                    '$ \\text{c. }1.07 $',
                    '$ \\text{d. }2.12 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }2.07 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 5,
                'question_type' => 'identification_math',
                'question' => 'Add 1/2 and 1/3. Express your answer in simplest form.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{1}{2}+\\frac{1}{3}=\\frac{3}{6}+\\frac{2}{6}=\\frac{5}{6} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 5,
                'question_type' => 'multiple_choice_math',
                'question' => 'What is 3/4 × 2/9 in simplest form?',
                'choices' => json_encode([
                    '$ \\text{a. }\\frac{1}{6} $',
                    '$ \\text{b. }\\frac{5}{13} $',
                    '$ \\text{c. }\\frac{2}{3} $',
                    '$ \\text{d. }\\frac{1}{3} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\frac{1}{6} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 5,
                'question_type' => 'identification_math',
                'question' => 'Evaluate 2 1/2 ÷ 3/4. Express your answer as an improper fraction.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{5}{2}\\div\\frac{3}{4}=\\frac{5}{2}\\times\\frac{4}{3}=\\frac{10}{3} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 5,
                'question_type' => 'multiple_choice_math',
                'question' => 'Evaluate (2/3 + 1/4) ÷ (5/6 − 1/3).',
                'choices' => json_encode([
                    '$ \\text{a. }\\frac{11}{6} $',
                    '$ \\text{b. }\\frac{5}{6} $',
                    '$ \\text{c. }\\frac{11}{12} $',
                    '$ \\text{d. }\\frac{3}{2} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\frac{11}{6} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 6,
                'question_type' => 'identification_math',
                'question' => 'Write an algebraic expression for "five more than twice a number n".',
                'choices' => null,
                'answers' => json_encode([
                    '$ 2n+5 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 6,
                'question_type' => 'multiple_choice_math',
                'question' => 'Which algebraic expression represents "seven less than three times a number n"?',
                'choices' => json_encode([
                    '$ \\text{a. }3n-7 $',
                    '$ \\text{b. }7-3n $',
                    '$ \\text{c. }3\\left(n-7\\right) $',
                    '$ \\text{d. }3n+7 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }3n-7 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 6,
                'question_type' => 'identification_math',
                'question' => 'The length of a rectangle is 3 more than twice its width w. Write a simplified expression for its perimeter.',
                'choices' => null,
                'answers' => json_encode([
                    '$ P=2w+2\\left(2w+3\\right)=6w+6 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 6,
                'question_type' => 'multiple_choice_math',
                'question' => 'The smallest of three consecutive integers is n. Which expression represents their sum?',
                'choices' => json_encode([
                    '$ \\text{a. }3n+3 $',
                    '$ \\text{b. }3n $',
                    '$ \\text{c. }n+3 $',
                    '$ \\text{d. }3n+1 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }3n+3 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'identification',
                'question' => 'A bar graph shows the number of students in each section: Section A – 30, Section B – 25, Section C – 35, Section D – 20. Which section has the most students?',
                'choices' => null,
                'answers' => json_encode([
                    'Section C'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'multiple_choice',
                'question' => 'A line graph shows a plant\'s height: Week 1 – 2 cm, Week 2 – 5 cm, Week 3 – 9 cm, Week 4 – 14 cm. Which statement correctly describes the graph?',
                'choices' => json_encode([
                    'a. The plant\'s height decreases each week.',
                    'b. The plant grows by the same amount each week.',
                    'c. The plant grows by a larger amount each week.',
                    'd. The plant stopped growing after Week 2.'
                ]),
                'answers' => json_encode([
                    'c. The plant grows by a larger amount each week.'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'identification',
                'question' => 'A pie chart shows how a family spends a monthly budget of ₱20,000: Food 40%, Transportation 25%, Education 20%, Others 15%. How much is spent on Education?',
                'choices' => null,
                'answers' => json_encode([
                    '₱4,000'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'multiple_choice',
                'question' => 'Students who studied 1, 2, 3, 4, and 5 hours scored 55, 62, 70, 78, and 85 respectively on a test. Which is the best interpretation of the scatter plot of this data?',
                'choices' => json_encode([
                    'a. As study hours increase, test scores increase.',
                    'b. As study hours increase, test scores decrease.',
                    'c. There is no relationship between study hours and test scores.',
                    'd. Test scores stay the same regardless of study hours.'
                ]),
                'answers' => json_encode([
                    'a. As study hours increase, test scores increase.'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 8,
                'question_type' => 'identification_math',
                'question' => 'Find the range of the data set 12, 7, 19, 4, 15.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 19-4=15 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 8,
                'question_type' => 'multiple_choice',
                'question' => 'Which data set has the greatest range?',
                'choices' => json_encode([
                    'a. Set A: 5, 6, 7, 8',
                    'b. Set B: 2, 4, 6, 12',
                    'c. Set C: 10, 10, 11, 11',
                    'd. Set D: 3, 5, 7, 9'
                ]),
                'answers' => json_encode([
                    'b. Set B: 2, 4, 6, 12'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 8,
                'question_type' => 'identification_math',
                'question' => 'Find the mean absolute deviation of the data set 4, 6, 8, 10, 12.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{4+2+0+2+4}{5}=2.4 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 8,
                'question_type' => 'multiple_choice',
                'question' => 'Two classes both have a mean score of 80. Class A has a standard deviation of 3 and Class B has a standard deviation of 10. Which statement is correct?',
                'choices' => json_encode([
                    'a. Class A\'s scores are more consistent because they are closer to the mean.',
                    'b. Class B\'s scores are more consistent because they are closer to the mean.',
                    'c. Both classes have identical score distributions.',
                    'd. Class B has a higher average score than Class A.'
                ]),
                'answers' => json_encode([
                    'a. Class A\'s scores are more consistent because they are closer to the mean.'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 9,
                'question_type' => 'identification_math',
                'question' => 'A bag contains 3 red, 5 blue, and 2 green marbles. If one marble is drawn at random, what is the probability that it is red?',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{3}{10} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 9,
                'question_type' => 'multiple_choice_math',
                'question' => 'A fair six-sided die is rolled once. What is the probability of getting an even number or a number greater than 4?',
                'choices' => json_encode([
                    '$ \\text{a. }\\frac{2}{3} $',
                    '$ \\text{b. }\\frac{1}{2} $',
                    '$ \\text{c. }\\frac{1}{3} $',
                    '$ \\text{d. }\\frac{5}{6} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\frac{2}{3} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 9,
                'question_type' => 'identification_math',
                'question' => 'Two fair coins are tossed. What is the probability of getting at least one head?',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{3}{4} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 9,
                'question_type' => 'multiple_choice_math',
                'question' => 'Two fair dice are rolled. What is the probability that the sum of the numbers is 8?',
                'choices' => json_encode([
                    '$ \\text{a. }\\frac{5}{36} $',
                    '$ \\text{b. }\\frac{1}{6} $',
                    '$ \\text{c. }\\frac{1}{9} $',
                    '$ \\text{d. }\\frac{7}{36} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\frac{5}{36} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 10,
                'question_type' => 'identification_math',
                'question' => 'What is the distance between −4 and 7 on a number line?',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\left|7-\\left(-4\\right)\\right|=11 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 10,
                'question_type' => 'multiple_choice_math',
                'question' => 'Which number lies between −2.5 and −1/2 on the number line?',
                'choices' => json_encode([
                    '$ \\text{a. }-3 $',
                    '$ \\text{b. }-1 $',
                    '$ \\text{c. }0 $',
                    '$ \\text{d. }1 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{b. }-1 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 10,
                'question_type' => 'identification_math',
                'question' => 'What number is exactly halfway between −6 and 10 on a number line?',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{-6+10}{2}=2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 10,
                'question_type' => 'multiple_choice_math',
                'question' => 'A point starts at −7 on a number line, moves 12 units to the right, then 9 units to the left. Where does it end?',
                'choices' => json_encode([
                    '$ \\text{a. }-4 $',
                    '$ \\text{b. }14 $',
                    '$ \\text{c. }-28 $',
                    '$ \\text{d. }4 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }-4 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 11,
                'question_type' => 'identification',
                'question' => 'In which quadrant of the Cartesian plane is the point (−3, 5) located?',
                'choices' => null,
                'answers' => json_encode([
                    'Quadrant II'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 11,
                'question_type' => 'multiple_choice_math',
                'question' => 'Which point lies on the x-axis?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(0,4\\right) $',
                    '$ \\text{b. }\\left(-3,0\\right) $',
                    '$ \\text{c. }\\left(2,2\\right) $',
                    '$ \\text{d. }\\left(5,-1\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{b. }\\left(-3,0\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 11,
                'question_type' => 'identification_math',
                'question' => 'What are the coordinates of the image of the point (4, −2) after it is reflected across the y-axis?',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\left(-4,-2\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 11,
                'question_type' => 'multiple_choice_math',
                'question' => 'Three vertices of a rectangle are (1, 1), (5, 1), and (5, 4). What are the coordinates of the fourth vertex?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(1,4\\right) $',
                    '$ \\text{b. }\\left(4,1\\right) $',
                    '$ \\text{c. }\\left(1,5\\right) $',
                    '$ \\text{d. }\\left(4,4\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(1,4\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 12,
                'question_type' => 'identification_math',
                'question' => 'Find the distance between the points (1, 2) and (4, 6).',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\sqrt{\\left(4-1\\right)^2+\\left(6-2\\right)^2}=\\sqrt{25}=5 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 12,
                'question_type' => 'multiple_choice_math',
                'question' => 'What is the distance between the points (−2, 3) and (4, −5)?',
                'choices' => json_encode([
                    '$ \\text{a. }10 $',
                    '$ \\text{b. }14 $',
                    '$ \\text{c. }2 $',
                    '$ \\text{d. }8 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }10 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 12,
                'question_type' => 'identification_math',
                'question' => 'Find the distance between A(−1, −2) and B(4, 10).',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\sqrt{\\left(4-\\left(-1\\right)\\right)^2+\\left(10-\\left(-2\\right)\\right)^2}=\\sqrt{169}=13 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 12,
                'question_type' => 'multiple_choice_math',
                'question' => 'The distance between the points (1, 2) and (k, 6) is 5 units. What are the possible values of k?',
                'choices' => json_encode([
                    '$ \\text{a. }k=4\\text{ or }k=-2 $',
                    '$ \\text{b. }k=4\\text{ only} $',
                    '$ \\text{c. }k=-2\\text{ only} $',
                    '$ \\text{d. }k=5\\text{ or }k=-5 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }k=4\\text{ or }k=-2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 13,
                'question_type' => 'identification_math',
                'question' => 'Find the area of a triangle with a base of 10 cm and a height of 6 cm.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{1}{2}\\left(10\\right)\\left(6\\right)=30\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 13,
                'question_type' => 'multiple_choice_math',
                'question' => 'A triangle has an area of 48 cm² and a base of 12 cm. What is its height?',
                'choices' => json_encode([
                    '$ \\text{a. }4\\text{ cm} $',
                    '$ \\text{b. }8\\text{ cm} $',
                    '$ \\text{c. }6\\text{ cm} $',
                    '$ \\text{d. }16\\text{ cm} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{b. }8\\text{ cm} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 13,
                'question_type' => 'identification_math',
                'question' => 'A right triangle has legs measuring 9 cm and 12 cm. Find its area.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{1}{2}\\left(9\\right)\\left(12\\right)=54\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 13,
                'question_type' => 'multiple_choice_math',
                'question' => 'A triangle has sides measuring 13 cm, 14 cm, and 15 cm. What is its area?',
                'choices' => json_encode([
                    '$ \\text{a. }84\\text{ cm}^2 $',
                    '$ \\text{b. }91\\text{ cm}^2 $',
                    '$ \\text{c. }105\\text{ cm}^2 $',
                    '$ \\text{d. }42\\text{ cm}^2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }84\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 14,
                'question_type' => 'identification_math',
                'question' => 'Two angles of a triangle measure 50° and 60°. Find the measure of the third angle.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 180^\\circ-50^\\circ-60^\\circ=70^\\circ $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 14,
                'question_type' => 'multiple_choice_math',
                'question' => 'The angles of a triangle measure x°, 2x°, and 3x°. What is the measure of the largest angle?',
                'choices' => json_encode([
                    '$ \\text{a. }30^\\circ $',
                    '$ \\text{b. }60^\\circ $',
                    '$ \\text{c. }90^\\circ $',
                    '$ \\text{d. }120^\\circ $'
                ]),
                'answers' => json_encode([
                    '$ \\text{c. }90^\\circ $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 14,
                'question_type' => 'identification_math',
                'question' => 'An exterior angle of a triangle measures 120°. One of its remote interior angles measures 45°. Find the other remote interior angle.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 120^\\circ-45^\\circ=75^\\circ $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 14,
                'question_type' => 'multiple_choice_math',
                'question' => 'The angles of a triangle measure (2x + 5)°, (3x − 5)°, and (x + 60)°. What is the measure of the largest angle?',
                'choices' => json_encode([
                    '$ \\text{a. }45^\\circ $',
                    '$ \\text{b. }55^\\circ $',
                    '$ \\text{c. }80^\\circ $',
                    '$ \\text{d. }100^\\circ $'
                ]),
                'answers' => json_encode([
                    '$ \\text{c. }80^\\circ $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 15,
                'question_type' => 'identification',
                'question' => 'Can line segments measuring 3 cm, 4 cm, and 8 cm form a triangle? Explain your answer.',
                'choices' => null,
                'answers' => json_encode([
                    'No. The sum of the two shorter sides (3 + 4 = 7) is not greater than the longest side (8).'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 15,
                'question_type' => 'multiple_choice_math',
                'question' => 'Two sides of a triangle measure 7 cm and 10 cm. Which could be the length of the third side?',
                'choices' => json_encode([
                    '$ \\text{a. }2\\text{ cm} $',
                    '$ \\text{b. }3\\text{ cm} $',
                    '$ \\text{c. }12\\text{ cm} $',
                    '$ \\text{d. }17\\text{ cm} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{c. }12\\text{ cm} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 15,
                'question_type' => 'identification_math',
                'question' => 'Two sides of a triangle measure 6 cm and 11 cm. Write an inequality for the possible length x of the third side.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 5<x<17 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 15,
                'question_type' => 'multiple_choice_math',
                'question' => 'A right triangle has a hypotenuse of 17 cm and one leg of 8 cm. What is the length of the other leg?',
                'choices' => json_encode([
                    '$ \\text{a. }15\\text{ cm} $',
                    '$ \\text{b. }9\\text{ cm} $',
                    '$ \\text{c. }25\\text{ cm} $',
                    '$ \\text{d. }12\\text{ cm} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }15\\text{ cm} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 16,
                'question_type' => 'identification_math',
                'question' => 'Find the area of a circle with a radius of 5 cm. Use π = 3.14.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3.14\\left(5\\right)^2=78.5\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 16,
                'question_type' => 'multiple_choice_math',
                'question' => 'A circle has a diameter of 14 cm. What is its area in terms of π?',
                'choices' => json_encode([
                    '$ \\text{a. }49\\pi\\text{ cm}^2 $',
                    '$ \\text{b. }14\\pi\\text{ cm}^2 $',
                    '$ \\text{c. }196\\pi\\text{ cm}^2 $',
                    '$ \\text{d. }7\\pi\\text{ cm}^2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }49\\pi\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 16,
                'question_type' => 'identification_math',
                'question' => 'A circle has an area of 64π cm². Find its radius.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\pi r^2=64\\pi \\Rightarrow r=8\\text{ cm} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 16,
                'question_type' => 'multiple_choice_math',
                'question' => 'A circle is inscribed in a square with sides 10 cm long. What is the area of the region inside the square but outside the circle?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(100-25\\pi\\right)\\text{ cm}^2 $',
                    '$ \\text{b. }\\left(100-10\\pi\\right)\\text{ cm}^2 $',
                    '$ \\text{c. }\\left(100-100\\pi\\right)\\text{ cm}^2 $',
                    '$ \\text{d. }25\\pi\\text{ cm}^2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(100-25\\pi\\right)\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 17,
                'question_type' => 'identification_math',
                'question' => 'Find the circumference of a circle with a diameter of 10 cm. Use π = 3.14.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3.14\\left(10\\right)=31.4\\text{ cm} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 17,
                'question_type' => 'multiple_choice_math',
                'question' => 'A circle has a radius of 7 cm. What is its circumference in terms of π?',
                'choices' => json_encode([
                    '$ \\text{a. }14\\pi\\text{ cm} $',
                    '$ \\text{b. }7\\pi\\text{ cm} $',
                    '$ \\text{c. }49\\pi\\text{ cm} $',
                    '$ \\text{d. }28\\pi\\text{ cm} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }14\\pi\\text{ cm} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 17,
                'question_type' => 'identification_math',
                'question' => 'A circle has a circumference of 25.12 cm. Find its radius. Use π = 3.14.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 2\\left(3.14\\right)r=25.12 \\Rightarrow r=4\\text{ cm} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 17,
                'question_type' => 'multiple_choice_math',
                'question' => 'A wheel has a radius of 35 cm. How many complete rotations will it make to travel 22 m? Use π = 22/7.',
                'choices' => json_encode([
                    '$ \\text{a. }10 $',
                    '$ \\text{b. }100 $',
                    '$ \\text{c. }5 $',
                    '$ \\text{d. }20 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }10 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 18,
                'question_type' => 'identification_math',
                'question' => 'Find the volume of a cylinder with a radius of 3 cm and a height of 10 cm. Use π = 3.14.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3.14\\left(3\\right)^2\\left(10\\right)=282.6\\text{ cm}^3 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 18,
                'question_type' => 'multiple_choice_math',
                'question' => 'A cylinder has a radius of 5 cm and a height of 12 cm. What is its volume in terms of π?',
                'choices' => json_encode([
                    '$ \\text{a. }300\\pi\\text{ cm}^3 $',
                    '$ \\text{b. }60\\pi\\text{ cm}^3 $',
                    '$ \\text{c. }150\\pi\\text{ cm}^3 $',
                    '$ \\text{d. }120\\pi\\text{ cm}^3 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }300\\pi\\text{ cm}^3 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 18,
                'question_type' => 'identification_math',
                'question' => 'A cylinder has a volume of 150π cm³ and a radius of 5 cm. Find its height.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 150\\pi=\\pi\\left(5\\right)^2h \\Rightarrow h=6\\text{ cm} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 18,
                'question_type' => 'multiple_choice',
                'question' => 'The radius of a cylinder is doubled while its height stays the same. What happens to its volume?',
                'choices' => json_encode([
                    'a. It is doubled.',
                    'b. It becomes 4 times as large.',
                    'c. It becomes 8 times as large.',
                    'd. It stays the same.'
                ]),
                'answers' => json_encode([
                    'b. It becomes 4 times as large.'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 19,
                'question_type' => 'identification',
                'question' => 'How many degrees is a half-turn rotation?',
                'choices' => null,
                'answers' => json_encode([
                    '180 degrees'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 19,
                'question_type' => 'multiple_choice_math',
                'question' => 'What are the coordinates of the point (3, 1) after a 90° counterclockwise rotation about the origin?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(-1,3\\right) $',
                    '$ \\text{b. }\\left(1,-3\\right) $',
                    '$ \\text{c. }\\left(-3,-1\\right) $',
                    '$ \\text{d. }\\left(3,-1\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(-1,3\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 19,
                'question_type' => 'identification_math',
                'question' => 'Find the image of the point (−2, 5) after a 180° rotation about the origin.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\left(2,-5\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 19,
                'question_type' => 'multiple_choice_math',
                'question' => 'What are the coordinates of the point (4, −3) after a 90° clockwise rotation about the origin?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(-3,-4\\right) $',
                    '$ \\text{b. }\\left(3,4\\right) $',
                    '$ \\text{c. }\\left(3,-4\\right) $',
                    '$ \\text{d. }\\left(-4,-3\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(-3,-4\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 20,
                'question_type' => 'identification_math',
                'question' => 'Simplify the expression 3x + 5x − 2x.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3x+5x-2x=6x $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 20,
                'question_type' => 'multiple_choice_math',
                'question' => 'Simplify 4(x + 3) − 2(x − 1).',
                'choices' => json_encode([
                    '$ \\text{a. }2x+14 $',
                    '$ \\text{b. }6x+14 $',
                    '$ \\text{c. }2x+10 $',
                    '$ \\text{d. }2x+12 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }2x+14 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 20,
                'question_type' => 'identification_math',
                'question' => 'Evaluate 3a² − 2b when a = 4 and b = 5.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3\\left(4\\right)^2-2\\left(5\\right)=48-10=38 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 20,
                'question_type' => 'multiple_choice_math',
                'question' => 'Simplify (2x + 3)(x − 4).',
                'choices' => json_encode([
                    '$ \\text{a. }2x^2-5x-12 $',
                    '$ \\text{b. }2x^2+5x-12 $',
                    '$ \\text{c. }2x^2-11x-12 $',
                    '$ \\text{d. }2x^2-5x+12 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }2x^2-5x-12 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 21,
                'question_type' => 'identification_math',
                'question' => 'Solve for x: x + 7 = 15.',
                'choices' => null,
                'answers' => json_encode([
                    '$ x=15-7=8 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 21,
                'question_type' => 'multiple_choice_math',
                'question' => 'Solve for x: 3x − 5 = 16.',
                'choices' => json_encode([
                    '$ \\text{a. }7 $',
                    '$ \\text{b. }3 $',
                    '$ \\text{c. }11 $',
                    '$ \\text{d. }\\frac{11}{3} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }7 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 21,
                'question_type' => 'identification_math',
                'question' => 'Solve for x: 2(x + 3) = 5x − 9.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 2x+6=5x-9 \\Rightarrow 15=3x \\Rightarrow x=5 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 21,
                'question_type' => 'multiple_choice_math',
                'question' => 'Which ordered pair (x, y) is the solution of the system x + y = 10 and x − y = 4?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(7,3\\right) $',
                    '$ \\text{b. }\\left(6,4\\right) $',
                    '$ \\text{c. }\\left(8,2\\right) $',
                    '$ \\text{d. }\\left(5,5\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(7,3\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 22,
                'question_type' => 'identification',
                'question' => 'In solving x − 4 = 9, you add 4 to both sides to get x = 13. Which property of equality justifies this step?',
                'choices' => null,
                'answers' => json_encode([
                    'Addition Property of Equality'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 22,
                'question_type' => 'multiple_choice',
                'question' => 'If a = b and b = c, then a = c. Which property of equality is shown?',
                'choices' => json_encode([
                    'a. Reflexive Property',
                    'b. Symmetric Property',
                    'c. Transitive Property',
                    'd. Substitution Property'
                ]),
                'answers' => json_encode([
                    'c. Transitive Property'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 22,
                'question_type' => 'identification',
                'question' => 'In solving 3x = 21, you divide both sides by 3 to get x = 7. Which property of equality justifies this step?',
                'choices' => null,
                'answers' => json_encode([
                    'Division Property of Equality'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 22,
                'question_type' => 'multiple_choice',
                'question' => 'Given x = 5 and x + y = 12, you conclude that 5 + y = 12. Which property of equality justifies this step?',
                'choices' => json_encode([
                    'a. Substitution Property',
                    'b. Reflexive Property',
                    'c. Symmetric Property',
                    'd. Addition Property'
                ]),
                'answers' => json_encode([
                    'a. Substitution Property'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 23,
                'question_type' => 'identification_math',
                'question' => 'Find the value of y in y = 3x − 1 when x = 2.',
                'choices' => null,
                'answers' => json_encode([
                    '$ y=3\\left(2\\right)-1=5 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 23,
                'question_type' => 'multiple_choice_math',
                'question' => 'What is the slope of the line passing through (1, 2) and (3, 8)?',
                'choices' => json_encode([
                    '$ \\text{a. }3 $',
                    '$ \\text{b. }2 $',
                    '$ \\text{c. }6 $',
                    '$ \\text{d. }\\frac{1}{3} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }3 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 23,
                'question_type' => 'identification_math',
                'question' => 'Write the equation of the line with a slope of 2 and a y-intercept of −3.',
                'choices' => null,
                'answers' => json_encode([
                    '$ y=2x-3 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 23,
                'question_type' => 'multiple_choice_math',
                'question' => 'Which equation represents the line passing through (0, 1) and (2, 5)?',
                'choices' => json_encode([
                    '$ \\text{a. }y=2x+1 $',
                    '$ \\text{b. }y=2x+5 $',
                    '$ \\text{c. }y=4x+1 $',
                    '$ \\text{d. }y=\\frac{1}{2}x+1 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }y=2x+1 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 24,
                'question_type' => 'identification_math',
                'question' => 'Use the formula P = 2(l + w) to find the perimeter of a rectangle with length 8 cm and width 5 cm.',
                'choices' => null,
                'answers' => json_encode([
                    '$ P=2\\left(8+5\\right)=26\\text{ cm} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 24,
                'question_type' => 'multiple_choice_math',
                'question' => 'Solve the formula A = lw for w.',
                'choices' => json_encode([
                    '$ \\text{a. }w=\\frac{A}{l} $',
                    '$ \\text{b. }w=Al $',
                    '$ \\text{c. }w=A-l $',
                    '$ \\text{d. }w=\\frac{l}{A} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }w=\\frac{A}{l} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 24,
                'question_type' => 'identification_math',
                'question' => 'Use the formula F = (9/5)C + 32 to convert 25°C to degrees Fahrenheit.',
                'choices' => null,
                'answers' => json_encode([
                    '$ F=\\frac{9}{5}\\left(25\\right)+32=77 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 24,
                'question_type' => 'multiple_choice_math',
                'question' => 'Solve the formula V = (1/3)πr²h for r (r > 0).',
                'choices' => json_encode([
                    '$ \\text{a. }r=\\sqrt{\\frac{3V}{\\pi h}} $',
                    '$ \\text{b. }r=\\frac{3V}{\\pi h} $',
                    '$ \\text{c. }r=\\sqrt{3V\\pi h} $',
                    '$ \\text{d. }r=\\sqrt{\\frac{V}{3\\pi h}} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }r=\\sqrt{\\frac{3V}{\\pi h}} $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 25,
                'question_type' => 'identification_math',
                'question' => 'What is the y-intercept of the graph of y = x + 4? Write it as an ordered pair.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\left(0,4\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 25,
                'question_type' => 'multiple_choice_math',
                'question' => 'What is the x-intercept of the graph of y = 2x − 6?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(3,0\\right) $',
                    '$ \\text{b. }\\left(0,-6\\right) $',
                    '$ \\text{c. }\\left(-3,0\\right) $',
                    '$ \\text{d. }\\left(6,0\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(3,0\\right) $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 25,
                'question_type' => 'identification_math',
                'question' => 'Write 3x + y = 9 in slope-intercept form, then identify its slope and y-intercept.',
                'choices' => null,
                'answers' => json_encode([
                    '$ y=-3x+9;\\ m=-3,\\ b=9 $'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ],
            [
                'is_active' => true,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 25,
                'question_type' => 'multiple_choice',
                'question' => 'The graphs of y = 2x + 1 and y = 2x − 5 are drawn on the same coordinate plane. How are the two lines related?',
                'choices' => json_encode([
                    'a. They are parallel.',
                    'b. They are perpendicular.',
                    'c. They intersect at exactly one point.',
                    'd. They are the same line.'
                ]),
                'answers' => json_encode([
                    'a. They are parallel.'
                ]),
                'assessment_type' => 'initial',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ]
        ]);
    }
}