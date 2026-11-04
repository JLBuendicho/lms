<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PracticeQuestionsSeeder extends Seeder
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
                'question' => 'Evaluate 20 − 4 × 3 + 2. Show your computation.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 20-12+2=10 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Evaluate (18 − 6) ÷ 3 + 2².',
                'choices' => json_encode([
                    '$ \\text{a. }8 $',
                    '$ \\text{b. }20 $',
                    '$ \\text{c. }6 $',
                    '$ \\text{d. }12 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }8 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Evaluate 3[12 − (2 + 4)² ÷ 9]. Show your computation.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3\\left[12-36\\div9\\right]=3\\left[12-4\\right]=24 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Evaluate 48 ÷ 2³ × 3 − (7 − 4)².',
                'choices' => json_encode([
                    '$ \\text{a. }9 $',
                    '$ \\text{b. }27 $',
                    '$ \\text{c. }3 $',
                    '$ \\text{d. }15 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }9 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Study the number expressions: 1 × 2 = 2, 2 × 3 = 6, 3 × 4 = 12. Write the next number expression in the pattern and its value.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 4\\times5=20 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Which expression gives the nth term of the sequence 4, 7, 10, 13, …?',
                'choices' => json_encode([
                    '$ \\text{a. }3n+1 $',
                    '$ \\text{b. }4n $',
                    '$ \\text{c. }n+3 $',
                    '$ \\text{d. }3n+4 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }3n+1 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Write an expression for the nth term of the sequence 3, 8, 15, 24, …',
                'choices' => null,
                'answers' => json_encode([
                    '$ n\\left(n+2\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Which expression gives the nth term of the sequence 2, 5, 10, 17, 26, …?',
                'choices' => json_encode([
                    '$ \\text{a. }n^2+1 $',
                    '$ \\text{b. }3n-1 $',
                    '$ \\text{c. }n^2+n $',
                    '$ \\text{d. }2^n+1 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }n^2+1 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Evaluate 3⁴. Show your computation.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3^4=3\\times3\\times3\\times3=81 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Simplify (y²)⁵.',
                'choices' => json_encode([
                    '$ \\text{a. }y^{10} $',
                    '$ \\text{b. }y^7 $',
                    '$ \\text{c. }y^{25} $',
                    '$ \\text{d. }5y^2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }y^{10} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Simplify x⁷ ÷ x³ · x².',
                'choices' => null,
                'answers' => json_encode([
                    '$ x^7\\div x^3\\cdot x^2=x^4\\cdot x^2=x^6 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Simplify (2x⁻²y³)² ÷ (4x⁻¹y). Express your answer with positive exponents.',
                'choices' => json_encode([
                    '$ \\text{a. }\\frac{y^5}{x^3} $',
                    '$ \\text{b. }\\frac{y^5}{x^5} $',
                    '$ \\text{c. }x^3y^5 $',
                    '$ \\text{d. }\\frac{y^4}{x^3} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\frac{y^5}{x^3} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Subtract 4.27 from 10.5.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 10.5-4.27=6.23 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What is 0.6 × 0.7?',
                'choices' => json_encode([
                    '$ \\text{a. }0.42 $',
                    '$ \\text{b. }4.2 $',
                    '$ \\text{c. }0.042 $',
                    '$ \\text{d. }1.3 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }0.42 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Divide 4.5 by 0.15.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 4.5\\div0.15=30 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Evaluate 2.5 × 1.2 − 0.9 ÷ 0.3 + 0.75.',
                'choices' => json_encode([
                    '$ \\text{a. }0.75 $',
                    '$ \\text{b. }3.75 $',
                    '$ \\text{c. }0.25 $',
                    '$ \\text{d. }1.75 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }0.75 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Subtract 1/6 from 3/4. Express your answer in simplest form.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{9}{12}-\\frac{2}{12}=\\frac{7}{12} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What is 5/6 ÷ 5/12?',
                'choices' => json_encode([
                    '$ \\text{a. }2 $',
                    '$ \\text{b. }\\frac{1}{2} $',
                    '$ \\text{c. }\\frac{25}{72} $',
                    '$ \\text{d. }\\frac{5}{2} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Add 1 2/3 and 2 3/4. Express your answer as a mixed number.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{5}{3}+\\frac{11}{4}=\\frac{53}{12}=4\\frac{5}{12} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Evaluate (3/4)² ÷ 3/8.',
                'choices' => json_encode([
                    '$ \\text{a. }\\frac{3}{2} $',
                    '$ \\text{b. }\\frac{9}{32} $',
                    '$ \\text{c. }\\frac{3}{4} $',
                    '$ \\text{d. }\\frac{2}{3} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\frac{3}{2} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Write an algebraic expression for "a number n is decreased by 8, then the result is doubled".',
                'choices' => null,
                'answers' => json_encode([
                    '$ 2\\left(n-8\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Ana is x years old. Her mother is 5 years more than three times Ana\'s age. Which expression represents her mother\'s age?',
                'choices' => json_encode([
                    '$ \\text{a. }3x+5 $',
                    '$ \\text{b. }3\\left(x+5\\right) $',
                    '$ \\text{c. }x+15 $',
                    '$ \\text{d. }5x+3 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }3x+5 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A notebook costs ₱x and a pen costs ₱5 less than a notebook. Write a simplified expression for the cost of 3 notebooks and 4 pens.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3x+4\\left(x-5\\right)=7x-20 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'The smallest of three consecutive even integers is n. Which expression represents their sum?',
                'choices' => json_encode([
                    '$ \\text{a. }3n+6 $',
                    '$ \\text{b. }3n+3 $',
                    '$ \\text{c. }3n+2 $',
                    '$ \\text{d. }n+6 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }3n+6 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A bar graph shows the number of books borrowed each day: Monday – 12, Tuesday – 18, Wednesday – 9, Thursday – 15, Friday – 21. On which day were the fewest books borrowed?',
                'choices' => null,
                'answers' => json_encode([
                    'Wednesday'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A line graph shows the temperature (°C) during the day: 6 AM – 22, 9 AM – 25, 12 NN – 31, 3 PM – 33, 6 PM – 28. During which period did the temperature increase the most?',
                'choices' => json_encode([
                    'a. 6 AM to 9 AM',
                    'b. 9 AM to 12 NN',
                    'c. 12 NN to 3 PM',
                    'd. 3 PM to 6 PM'
                ]),
                'answers' => json_encode([
                    'b. 9 AM to 12 NN'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A pie chart shows the favorite sports of 500 students: Basketball 35%, Volleyball 25%, Badminton 20%, Others 20%. How many students prefer basketball?',
                'choices' => null,
                'answers' => json_encode([
                    '175 students'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A store\'s quarterly sales (in thousands of pesos) are: Q1 – 120, Q2 – 150, Q3 – 135, Q4 – 180. Which statement is true?',
                'choices' => json_encode([
                    'a. Sales increased every quarter.',
                    'b. Sales were highest in Q4, and Q3 sales were lower than Q2 sales.',
                    'c. Sales were highest in Q1.',
                    'd. Sales were lowest in Q2.'
                ]),
                'answers' => json_encode([
                    'b. Sales were highest in Q4, and Q3 sales were lower than Q2 sales.'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the range of the data set 8, 15, 3, 22, 10.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 22-3=19 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Which statement about the data set 4, 4, 4, 4 is correct?',
                'choices' => json_encode([
                    'a. The data has no variability because all values are the same.',
                    'b. The data has high variability.',
                    'c. The range of the data is 4.',
                    'd. The mean of the data is 0.'
                ]),
                'answers' => json_encode([
                    'a. The data has no variability because all values are the same.'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the mean absolute deviation of the data set 2, 4, 6, 8.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{3+1+1+3}{4}=2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Section A scores: 70, 72, 71, 73, 74. Section B scores: 50, 60, 70, 80, 90. Which statement is correct?',
                'choices' => json_encode([
                    'a. Section A has greater variability because its mean is higher.',
                    'b. Section B has greater variability because its scores are more spread out.',
                    'c. Both sections have the same variability.',
                    'd. Variability cannot be compared when the means differ.'
                ]),
                'answers' => json_encode([
                    'b. Section B has greater variability because its scores are more spread out.'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A spinner has 8 equal sections numbered 1 to 8. What is the probability of landing on a number greater than 5?',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{3}{8} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A card is drawn at random from cards numbered 1 to 20. What is the probability that the number is a multiple of 5?',
                'choices' => json_encode([
                    '$ \\text{a. }\\frac{1}{5} $',
                    '$ \\text{b. }\\frac{1}{4} $',
                    '$ \\text{c. }\\frac{1}{20} $',
                    '$ \\text{d. }\\frac{1}{10} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\frac{1}{5} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Three fair coins are tossed. What is the probability of getting exactly two heads?',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{3}{8} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A bag has 5 red and 3 blue marbles. Two marbles are drawn one after the other without replacement. What is the probability that both are red?',
                'choices' => json_encode([
                    '$ \\text{a. }\\frac{5}{14} $',
                    '$ \\text{b. }\\frac{25}{64} $',
                    '$ \\text{c. }\\frac{5}{8} $',
                    '$ \\text{d. }\\frac{5}{28} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\frac{5}{14} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What is the distance between −9 and −2 on a number line?',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\left|-2-\\left(-9\\right)\\right|=7 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Which list shows the numbers in order from least to greatest?',
                'choices' => json_encode([
                    '$ \\text{a. }-3,\\ -0.5,\\ 0,\\ 1.5 $',
                    '$ \\text{b. }-0.5,\\ -3,\\ 0,\\ 1.5 $',
                    '$ \\text{c. }1.5,\\ 0,\\ -0.5,\\ -3 $',
                    '$ \\text{d. }-3,\\ 0,\\ -0.5,\\ 1.5 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }-3,\\ -0.5,\\ 0,\\ 1.5 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Point A is at −5 and point B is at 7 on a number line. What is the position of the point that is 1/3 of the way from A to B?',
                'choices' => null,
                'answers' => json_encode([
                    '$ -5+\\frac{1}{3}\\left(12\\right)=-1 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A number line shows a closed circle at −2 with the line shaded to the right. Which inequality does it represent?',
                'choices' => json_encode([
                    '$ \\text{a. }x\\geq-2 $',
                    '$ \\text{b. }x>-2 $',
                    '$ \\text{c. }x\\leq-2 $',
                    '$ \\text{d. }x<-2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }x\\geq-2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'In which quadrant of the Cartesian plane is the point (4, −6) located?',
                'choices' => null,
                'answers' => json_encode([
                    'Quadrant IV'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Which point lies on the y-axis?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(5,0\\right) $',
                    '$ \\text{b. }\\left(0,-3\\right) $',
                    '$ \\text{c. }\\left(2,2\\right) $',
                    '$ \\text{d. }\\left(-1,4\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{b. }\\left(0,-3\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'The point (3, −1) is translated 4 units to the left and 5 units up. What are the coordinates of its image?',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\left(-1,4\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'The endpoints of a segment are (−2, 3) and (6, 3). What are the coordinates of its midpoint?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(2,3\\right) $',
                    '$ \\text{b. }\\left(4,3\\right) $',
                    '$ \\text{c. }\\left(2,0\\right) $',
                    '$ \\text{d. }\\left(4,6\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(2,3\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the distance between the points (0, 0) and (6, 8).',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\sqrt{6^2+8^2}=\\sqrt{100}=10 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What is the distance between the points (3, −2) and (−1, 1)?',
                'choices' => json_encode([
                    '$ \\text{a. }5 $',
                    '$ \\text{b. }7 $',
                    '$ \\text{c. }25 $',
                    '$ \\text{d. }1 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }5 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the distance between the points (−5, 2) and (7, −3).',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\sqrt{\\left(7-\\left(-5\\right)\\right)^2+\\left(-3-2\\right)^2}=\\sqrt{169}=13 $'
                ]),
                'assessment_type' => 'practice',
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
                'question_type' => 'multiple_choice',
                'question' => 'A triangle has vertices A(0, 0), B(6, 0), and C(3, 4). Which best describes the triangle?',
                'choices' => json_encode([
                    'a. Isosceles, but not equilateral',
                    'b. Equilateral',
                    'c. Scalene',
                    'd. Right triangle'
                ]),
                'answers' => json_encode([
                    'a. Isosceles, but not equilateral'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the area of a triangle with a base of 8 cm and a height of 5 cm.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{1}{2}\\left(8\\right)\\left(5\\right)=20\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A triangle has an area of 35 cm² and a height of 10 cm. What is the length of its base?',
                'choices' => json_encode([
                    '$ \\text{a. }7\\text{ cm} $',
                    '$ \\text{b. }3.5\\text{ cm} $',
                    '$ \\text{c. }14\\text{ cm} $',
                    '$ \\text{d. }70\\text{ cm} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }7\\text{ cm} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the area of the triangle with vertices (0, 0), (8, 0), and (0, 6).',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{1}{2}\\left(8\\right)\\left(6\\right)=24\\text{ square units} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What is the area of an equilateral triangle with sides of 6 cm?',
                'choices' => json_encode([
                    '$ \\text{a. }9\\sqrt{3}\\text{ cm}^2 $',
                    '$ \\text{b. }18\\sqrt{3}\\text{ cm}^2 $',
                    '$ \\text{c. }36\\text{ cm}^2 $',
                    '$ \\text{d. }9\\text{ cm}^2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }9\\sqrt{3}\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Two angles of a triangle measure 35° and 85°. Find the measure of the third angle.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 180^\\circ-35^\\circ-85^\\circ=60^\\circ $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'One acute angle of a right triangle measures 28°. What is the measure of the other acute angle?',
                'choices' => json_encode([
                    '$ \\text{a. }62^\\circ $',
                    '$ \\text{b. }152^\\circ $',
                    '$ \\text{c. }28^\\circ $',
                    '$ \\text{d. }118^\\circ $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }62^\\circ $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'The vertex angle of an isosceles triangle measures 50°. Find the measure of each base angle.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{180^\\circ-50^\\circ}{2}=65^\\circ $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'The angles of a triangle measure 3x°, (4x − 10)°, and (5x + 10)°. What is the measure of the smallest angle?',
                'choices' => json_encode([
                    '$ \\text{a. }45^\\circ $',
                    '$ \\text{b. }50^\\circ $',
                    '$ \\text{c. }85^\\circ $',
                    '$ \\text{d. }15^\\circ $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }45^\\circ $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Can line segments measuring 5 cm, 7 cm, and 11 cm form a triangle? Explain your answer.',
                'choices' => null,
                'answers' => json_encode([
                    'Yes. The sum of the two shorter sides (5 + 7 = 12) is greater than the longest side (11).'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Two sides of a triangle measure 4 cm and 9 cm. Which CANNOT be the length of the third side?',
                'choices' => json_encode([
                    '$ \\text{a. }5\\text{ cm} $',
                    '$ \\text{b. }6\\text{ cm} $',
                    '$ \\text{c. }9\\text{ cm} $',
                    '$ \\text{d. }12\\text{ cm} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }5\\text{ cm} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Two sides of a triangle measure 8 cm and 15 cm. Write an inequality for the possible length x of the third side.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 7<x<23 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A right triangle has a hypotenuse of 26 cm and one leg of 10 cm. What is the length of the other leg?',
                'choices' => json_encode([
                    '$ \\text{a. }24\\text{ cm} $',
                    '$ \\text{b. }16\\text{ cm} $',
                    '$ \\text{c. }36\\text{ cm} $',
                    '$ \\text{d. }\\sqrt{776}\\text{ cm} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }24\\text{ cm} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the area of a circle with a radius of 10 cm. Use π = 3.14.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3.14\\left(10\\right)^2=314\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A circle has a radius of 9 cm. What is its area in terms of π?',
                'choices' => json_encode([
                    '$ \\text{a. }81\\pi\\text{ cm}^2 $',
                    '$ \\text{b. }18\\pi\\text{ cm}^2 $',
                    '$ \\text{c. }9\\pi\\text{ cm}^2 $',
                    '$ \\text{d. }162\\pi\\text{ cm}^2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }81\\pi\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A circle has a diameter of 12 cm. Find its area in terms of π.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\pi\\left(6\\right)^2=36\\pi\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A semicircle has a diameter of 20 cm. What is its area in terms of π?',
                'choices' => json_encode([
                    '$ \\text{a. }50\\pi\\text{ cm}^2 $',
                    '$ \\text{b. }100\\pi\\text{ cm}^2 $',
                    '$ \\text{c. }200\\pi\\text{ cm}^2 $',
                    '$ \\text{d. }25\\pi\\text{ cm}^2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }50\\pi\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the circumference of a circle with a radius of 6 cm. Use π = 3.14.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 2\\left(3.14\\right)\\left(6\\right)=37.68\\text{ cm} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A circle has a diameter of 18 cm. What is its circumference in terms of π?',
                'choices' => json_encode([
                    '$ \\text{a. }18\\pi\\text{ cm} $',
                    '$ \\text{b. }9\\pi\\text{ cm} $',
                    '$ \\text{c. }36\\pi\\text{ cm} $',
                    '$ \\text{d. }81\\pi\\text{ cm} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }18\\pi\\text{ cm} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A circle has a circumference of 31.4 cm. Find its diameter. Use π = 3.14.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3.14d=31.4 \\Rightarrow d=10\\text{ cm} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A circular track has a radius of 70 m. How far does Jun run if he completes 3 laps? Use π = 22/7.',
                'choices' => json_encode([
                    '$ \\text{a. }1320\\text{ m} $',
                    '$ \\text{b. }440\\text{ m} $',
                    '$ \\text{c. }2640\\text{ m} $',
                    '$ \\text{d. }660\\text{ m} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }1320\\text{ m} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the volume of a cylinder with a radius of 2 cm and a height of 7 cm. Use π = 22/7.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\frac{22}{7}\\left(2\\right)^2\\left(7\\right)=88\\text{ cm}^3 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A cylinder has a radius of 3 cm and a height of 8 cm. What is its volume in terms of π?',
                'choices' => json_encode([
                    '$ \\text{a. }72\\pi\\text{ cm}^3 $',
                    '$ \\text{b. }24\\pi\\text{ cm}^3 $',
                    '$ \\text{c. }48\\pi\\text{ cm}^3 $',
                    '$ \\text{d. }144\\pi\\text{ cm}^3 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }72\\pi\\text{ cm}^3 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A cylinder has a volume of 200π cm³ and a height of 8 cm. Find its radius.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 200\\pi=\\pi r^2\\left(8\\right) \\Rightarrow r^2=25 \\Rightarrow r=5\\text{ cm} $'
                ]),
                'assessment_type' => 'practice',
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
                'question_type' => 'multiple_choice_math',
                'question' => 'A cylindrical water tank has a diameter of 10 m and a height of 4 m. What is its volume in terms of π?',
                'choices' => json_encode([
                    '$ \\text{a. }100\\pi\\text{ m}^3 $',
                    '$ \\text{b. }200\\pi\\text{ m}^3 $',
                    '$ \\text{c. }40\\pi\\text{ m}^3 $',
                    '$ \\text{d. }400\\pi\\text{ m}^3 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }100\\pi\\text{ m}^3 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'How many degrees is a full-turn rotation?',
                'choices' => null,
                'answers' => json_encode([
                    '360 degrees'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What are the coordinates of the point (2, 5) after a 180° rotation about the origin?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(-2,-5\\right) $',
                    '$ \\text{b. }\\left(2,-5\\right) $',
                    '$ \\text{c. }\\left(-2,5\\right) $',
                    '$ \\text{d. }\\left(5,2\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(-2,-5\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the image of the point (−3, 2) after a 90° counterclockwise rotation about the origin.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\left(-2,-3\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What are the coordinates of the point (5, −1) after a 270° counterclockwise rotation about the origin?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(-1,-5\\right) $',
                    '$ \\text{b. }\\left(1,5\\right) $',
                    '$ \\text{c. }\\left(1,-5\\right) $',
                    '$ \\text{d. }\\left(-5,1\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(-1,-5\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Simplify the expression 7a − 3a + 2a.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 7a-3a+2a=6a $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Simplify 5(2x − 1) + 3(x + 4).',
                'choices' => json_encode([
                    '$ \\text{a. }13x+7 $',
                    '$ \\text{b. }13x+17 $',
                    '$ \\text{c. }7x+7 $',
                    '$ \\text{d. }13x-7 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }13x+7 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Evaluate x² − 3xy + y² when x = 2 and y = −1.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 2^2-3\\left(2\\right)\\left(-1\\right)+\\left(-1\\right)^2=4+6+1=11 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Simplify (x + 5)².',
                'choices' => json_encode([
                    '$ \\text{a. }x^2+10x+25 $',
                    '$ \\text{b. }x^2+25 $',
                    '$ \\text{c. }x^2+5x+25 $',
                    '$ \\text{d. }x^2+10x+10 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }x^2+10x+25 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Solve for x: x − 9 = 12.',
                'choices' => null,
                'answers' => json_encode([
                    '$ x=12+9=21 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Solve for x: 2x + 7 = 3x − 2.',
                'choices' => json_encode([
                    '$ \\text{a. }9 $',
                    '$ \\text{b. }5 $',
                    '$ \\text{c. }-9 $',
                    '$ \\text{d. }3 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }9 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Solve for x: 3(x − 2) + 4 = 2x + 5.',
                'choices' => null,
                'answers' => json_encode([
                    '$ 3x-2=2x+5 \\Rightarrow x=7 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Which ordered pair (x, y) is the solution of the system 2x + y = 11 and x − y = 1?',
                'choices' => json_encode([
                    '$ \\text{a. }\\left(4,3\\right) $',
                    '$ \\text{b. }\\left(3,5\\right) $',
                    '$ \\text{c. }\\left(5,1\\right) $',
                    '$ \\text{d. }\\left(6,-1\\right) $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }\\left(4,3\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'In solving x + 5 = 12, you subtract 5 from both sides to get x = 7. Which property of equality justifies this step?',
                'choices' => null,
                'answers' => json_encode([
                    'Subtraction Property of Equality'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'The statement a = a is an example of which property of equality?',
                'choices' => json_encode([
                    'a. Reflexive Property',
                    'b. Symmetric Property',
                    'c. Transitive Property',
                    'd. Substitution Property'
                ]),
                'answers' => json_encode([
                    'a. Reflexive Property'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'In solving x/4 = 6, you multiply both sides by 4 to get x = 24. Which property of equality justifies this step?',
                'choices' => null,
                'answers' => json_encode([
                    'Multiplication Property of Equality'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'If m = n, then n = m. Which property of equality is shown?',
                'choices' => json_encode([
                    'a. Symmetric Property',
                    'b. Reflexive Property',
                    'c. Transitive Property',
                    'd. Division Property'
                ]),
                'answers' => json_encode([
                    'a. Symmetric Property'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the value of y in y = 2x + 3 when x = 4.',
                'choices' => null,
                'answers' => json_encode([
                    '$ y=2\\left(4\\right)+3=11 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What is the slope of the line passing through (0, −1) and (4, 7)?',
                'choices' => json_encode([
                    '$ \\text{a. }2 $',
                    '$ \\text{b. }8 $',
                    '$ \\text{c. }4 $',
                    '$ \\text{d. }\\frac{1}{2} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Write the equation of the line with a slope of 3 that passes through (1, 2) in slope-intercept form.',
                'choices' => null,
                'answers' => json_encode([
                    '$ y-2=3\\left(x-1\\right) \\Rightarrow y=3x-1 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Which equation represents the line passing through (2, 1) and (4, −3)?',
                'choices' => json_encode([
                    '$ \\text{a. }y=-2x+5 $',
                    '$ \\text{b. }y=2x-3 $',
                    '$ \\text{c. }y=-2x+1 $',
                    '$ \\text{d. }y=-\\frac{1}{2}x+2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }y=-2x+5 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Use the formula A = ½bh to find the area of a triangle with a base of 12 cm and a height of 5 cm.',
                'choices' => null,
                'answers' => json_encode([
                    '$ A=\\frac{1}{2}\\left(12\\right)\\left(5\\right)=30\\text{ cm}^2 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Solve the formula P = 2l + 2w for l.',
                'choices' => json_encode([
                    '$ \\text{a. }l=\\frac{P-2w}{2} $',
                    '$ \\text{b. }l=P-2w $',
                    '$ \\text{c. }l=\\frac{P}{2}-2w $',
                    '$ \\text{d. }l=\\frac{P+2w}{2} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }l=\\frac{P-2w}{2} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Use the formula d = rt to find the rate r when d = 150 km and t = 2.5 hours.',
                'choices' => null,
                'answers' => json_encode([
                    '$ r=\\frac{d}{t}=\\frac{150}{2.5}=60\\text{ km/h} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Solve the formula A = ½(b₁ + b₂)h for h.',
                'choices' => json_encode([
                    '$ \\text{a. }h=\\frac{2A}{b_1+b_2} $',
                    '$ \\text{b. }h=\\frac{A}{2\\left(b_1+b_2\\right)} $',
                    '$ \\text{c. }h=2A\\left(b_1+b_2\\right) $',
                    '$ \\text{d. }h=\\frac{A}{b_1+b_2}-2 $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }h=\\frac{2A}{b_1+b_2} $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What is the y-intercept of the graph of y = 2x − 5? Write it as an ordered pair.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\left(0,-5\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'What is the slope of the graph of y = −4x + 1?',
                'choices' => json_encode([
                    '$ \\text{a. }-4 $',
                    '$ \\text{b. }4 $',
                    '$ \\text{c. }1 $',
                    '$ \\text{d. }-\\frac{1}{4} $'
                ]),
                'answers' => json_encode([
                    '$ \\text{a. }-4 $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'Find the x-intercept and y-intercept of the graph of 2x + 3y = 12.',
                'choices' => null,
                'answers' => json_encode([
                    '$ \\left(6,0\\right)\\text{ and }\\left(0,4\\right) $'
                ]),
                'assessment_type' => 'practice',
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
                'question' => 'A line has the equation y = −2x + 6. Which statement describes its graph?',
                'choices' => json_encode([
                    'a. It falls from left to right and crosses the y-axis at (0, 6).',
                    'b. It rises from left to right and crosses the y-axis at (0, 6).',
                    'c. It falls from left to right and crosses the y-axis at (0, −2).',
                    'd. It is a horizontal line.'
                ]),
                'answers' => json_encode([
                    'a. It falls from left to right and crosses the y-axis at (0, 6).'
                ]),
                'assessment_type' => 'practice',
                'created_at' => '2026-10-21 12:00:00',
                'updated_at' => '2026-10-21 12:00:00'
            ]
        ]);
    }
}