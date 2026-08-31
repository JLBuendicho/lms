<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'id' => 1,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 1,
                'question_type' => 'identification_math',
                'question' => 'Your classmate said that each of the four expressions in Box 1 is equivalent to 1. Verify what your classmate said by showing your computation for the number expression 4 × 4 − 5 × 3.',
                'answers' => json_encode([
    '$ 16-5=1 $'
]),
                'attachments' => json_encode([
    'questions/1/01KSJX6H884CAPXCT23EF609VZ.png'
]),
                'attachment_file_names' => json_encode([
    'questions/1/01KSJX6H884CAPXCT23EF609VZ.png' => 'box-1.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 14:22:03'
            ],
            [
                'id' => 2,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 2,
                'question_type' => 'identification_math',
                'question' => 'What must be the next number expression to 5 × 5 − 6 × 4 in Box 1?',
                'answers' => json_encode([
    '$ 6\\cdot6-7\\cdot5 $'
]),
                'attachments' => json_encode([
    'questions/2/01KSJXA52ZDC5K884HD7WP6W4Y.png'
]),
                'attachment_file_names' => json_encode([
    'questions/2/01KSJXA52ZDC5K884HD7WP6W4Y.png' => 'box-1.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:22:15'
            ],
            [
                'id' => 3,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 6,
                'question_type' => 'multiple_choice_math',
                'question' => 'Which of the following algebraic expressions represents the set of number expressions in Box 1?',
                'answers' => json_encode([
    'b',
    'c'
]),
                'attachments' => json_encode([
    'questions/3/01KSJXATJZ1CPM7RA08B99KTHZ.png',
    'questions/3/01KSK0N8X3ZF11R9QYG7TJ9FFZ.png'
]),
                'attachment_file_names' => json_encode([
    'questions/3/01KSJXATJZ1CPM7RA08B99KTHZ.png' => 'box-1.png',
    'questions/3/01KSK0N8X3ZF11R9QYG7TJ9FFZ.png' => 'choices-3.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:26:05'
            ],
            [
                'id' => 4,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 6,
                'question_type' => 'identification_math',
                'question' => 'Explain or show why you think you have chosen the correct algebraic expressions for the set of number expressions in Box 1.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/4/01KSJXR17GDCRF48A9908M5C6F.png'
]),
                'attachment_file_names' => json_encode([
    'questions/4/01KSJXR17GDCRF48A9908M5C6F.png' => 'box-1.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:56:18'
            ],
            [
                'id' => 5,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 6,
                'question_type' => 'identification',
                'question' => 'What does 𝑛 represent in your chosen expression in item 3?',
                'answers' => null,
                'attachments' => null,
                'attachment_file_names' => null,
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:00:23'
            ],
            [
                'id' => 6,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 3,
                'question_type' => 'identification_math',
                'question' => 'Show that 1024 is a power of 2. [Refer to Table 1]',
                'answers' => null,
                'attachments' => json_encode([
    'questions/6/01KSJXSS0654K4K2A9PVDV9QJ6.png'
]),
                'attachment_file_names' => json_encode([
    'questions/6/01KSJXSS0654K4K2A9PVDV9QJ6.png' => 'table-1.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:57:15'
            ],
            [
                'id' => 7,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 3,
                'question_type' => 'identification_math',
                'question' => 'Write the exponential form of 1024',
                'answers' => json_encode([
    '$ 2^{10} $'
]),
                'attachments' => json_encode([]),
                'attachment_file_names' => json_encode([]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:28:37'
            ],
            [
                'id' => 8,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 3,
                'question_type' => 'identification',
                'question' => 'Find a number that is a power of 2 that meets BOTH of these conditions: The number is a multiple of 16, The number is also more than 50 but less than 200.',
                'answers' => null,
                'attachments' => null,
                'attachment_file_names' => null,
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:00:23'
            ],
            [
                'id' => 9,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 4,
                'question_type' => 'identification',
                'question' => 'Is there a number between 0.998 and 0.999? If YES, give one example. If NO, explain why you think so.',
                'answers' => null,
                'attachments' => null,
                'attachment_file_names' => null,
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:00:23'
            ],
            [
                'id' => 10,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 4,
                'question_type' => 'identification_math',
                'question' => 'Show how you will subtract 0.998 from 0.999.',
                'answers' => json_encode([
    '$ 0.999-0.998=0.001 $'
]),
                'attachments' => json_encode([]),
                'attachment_file_names' => json_encode([]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:30:58'
            ],
            [
                'id' => 11,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 5,
                'question_type' => 'identification',
                'question' => 'Is there a fraction that is greater than 𝟑/𝟒 but less than 1? If YES, give one example. If NO, explain why you think so.',
                'answers' => null,
                'attachments' => null,
                'attachment_file_names' => null,
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:00:23'
            ],
            [
                'id' => 12,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'identification_math',
                'question' => 'How many students had an overall academic grade below 84? [Refer to Figure 1]',
                'answers' => json_encode([
    '$ 5 $'
]),
                'attachments' => json_encode([
    'questions/12/01KSJXVKFE18VJBEBWYP0SS03B.png'
]),
                'attachment_file_names' => json_encode([
    'questions/12/01KSJXVKFE18VJBEBWYP0SS03B.png' => 'figure-1.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:31:52'
            ],
            [
                'id' => 13,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'identification',
                'question' => 'Explain why you think your answer in item 12 is correct based on the information shown in the graph in Figure 1.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/13/01KSJXW0EEA8YG82AY16TE20H1.png'
]),
                'attachment_file_names' => json_encode([
    'questions/13/01KSJXW0EEA8YG82AY16TE20H1.png' => 'figure-1.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:58:28'
            ],
            [
                'id' => 14,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'multiple_choice',
                'question' => 'Which of the following can be a correct interpretation of the data presented in the graph in Figure 1?',
                'answers' => json_encode([
    'b',
    'c'
]),
                'attachments' => json_encode([
    'questions/14/01KSJXX00YV8M7J7HSDXY09VJP.png',
    'questions/14/01KSK0RQK9W357ZFGBVF955G0F.png'
]),
                'attachment_file_names' => json_encode([
    'questions/14/01KSJXX00YV8M7J7HSDXY09VJP.png' => 'figure-1.png',
    'questions/14/01KSK0RQK9W357ZFGBVF955G0F.png' => 'choices-14.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:33:07'
            ],
            [
                'id' => 15,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 8,
                'question_type' => 'identification_math',
                'question' => 'Based on the graph in Figure 2, which of the two puroks shows more diversity in monthly family income? Explain or justify your answer.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/15/01KSJXXG5KF53N35KKEB6Q6YZN.png'
]),
                'attachment_file_names' => json_encode([
    'questions/15/01KSJXXG5KF53N35KKEB6Q6YZN.png' => 'figure-2.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:59:17'
            ],
            [
                'id' => 16,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 8,
                'question_type' => 'identification',
                'question' => 'The average monthly income of the families in Purok 1 and Purok 2 are equal. Should both purok be given the same amount of financial aid? What information in the graph in Figure 2 did you base your decision on?',
                'answers' => null,
                'attachments' => json_encode([
    'questions/16/01KSJXY3DNXCPB0HS4EYYSPW7E.png'
]),
                'attachment_file_names' => json_encode([
    'questions/16/01KSJXY3DNXCPB0HS4EYYSPW7E.png' => 'figure-2.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:59:37'
            ],
            [
                'id' => 17,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'identification_math',
                'question' => 'How many students participated in the music activity?',
                'answers' => json_encode([
    '$ 49 $'
]),
                'attachments' => json_encode([
    'questions/17/01KSJXZDP8K556STMDA68ZQGAK.png'
]),
                'attachment_file_names' => json_encode([
    'questions/17/01KSJXZDP8K556STMDA68ZQGAK.png' => 'table-2.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:34:10'
            ],
            [
                'id' => 18,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'identification_math',
                'question' => 'How many students did not participate in any of the two activities?',
                'answers' => json_encode([
    '$ 19 $'
]),
                'attachments' => json_encode([
    'questions/18/01KSJY012HS3NCG538HVV519D7.png'
]),
                'attachment_file_names' => json_encode([
    'questions/18/01KSJY012HS3NCG538HVV519D7.png' => 'table-2.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:34:28'
            ],
            [
                'id' => 19,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 9,
                'question_type' => 'identification_math',
                'question' => 'What is the probability of selecting a student who participated in both music and sports activities?',
                'answers' => null,
                'attachments' => json_encode([
    'questions/19/01KSJY0G0Q6YT96FME7TPVKZ9S.png'
]),
                'attachment_file_names' => json_encode([
    'questions/19/01KSJY0G0Q6YT96FME7TPVKZ9S.png' => 'table-2.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 20:00:55'
            ],
            [
                'id' => 20,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 2,
                'topic_id' => 2,
                'skill_id' => 7,
                'question_type' => 'identification',
                'question' => 'Write a question that can be answered using the information in Table 2.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/20/01KSJY0S1ZJHN7GR565P4MQDBN.png'
]),
                'attachment_file_names' => json_encode([
    'questions/20/01KSJY0S1ZJHN7GR565P4MQDBN.png' => 'table-2.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 20:01:05'
            ],
            [
                'id' => 21,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 10,
                'question_type' => 'multiple_choice',
                'question' => 'What is the position of point 𝐹 in Figure 3?',
                'answers' => json_encode([
    'c'
]),
                'attachments' => json_encode([
    'questions/21/01KSJY17RA9RH4W8K4EVS6X58V.png',
    'questions/21/01KSK0TBVYTXGYMDAYP5CCH63A.png'
]),
                'attachment_file_names' => json_encode([
    'questions/21/01KSJY17RA9RH4W8K4EVS6X58V.png' => 'figure-3.png',
    'questions/21/01KSK0TBVYTXGYMDAYP5CCH63A.png' => 'choices-21.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 09:11:48'
            ],
            [
                'id' => 22,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 10,
                'question_type' => 'identification_math',
                'question' => 'What is the position of point 𝐺 in Figure 3?',
                'answers' => json_encode([
    '$ 0 $'
]),
                'attachments' => json_encode([
    'questions/22/01KSJY1T90XB2E95DQR3FP4H6K.png'
]),
                'attachment_file_names' => json_encode([
    'questions/22/01KSJY1T90XB2E95DQR3FP4H6K.png' => 'figure-3.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:35:14'
            ],
            [
                'id' => 23,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 11,
                'question_type' => 'identification_math',
                'question' => 'What are the coordinates of Point 𝐶 in Figure 4?',
                'answers' => json_encode([
    '$ (4,4) $'
]),
                'attachments' => json_encode([
    'questions/23/01KSJY2B1YQ2M1WE9RB7NSQZPX.png'
]),
                'attachment_file_names' => json_encode([
    'questions/23/01KSJY2B1YQ2M1WE9RB7NSQZPX.png' => 'figure-4.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:36:28'
            ],
            [
                'id' => 24,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 12,
                'question_type' => 'multiple_choice_math',
                'question' => 'A line is drawn passing through points 𝐵 and 𝐶 in Figure 4. Select two ordered pairs that represent the coordinates of points that are also in this line.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/24/01KSJY2ZDMFTYWT35KZ5QBHHX6.png',
    'questions/24/01KSK0WE4V6NJRMCZECPAXA1PX.png'
]),
                'attachment_file_names' => json_encode([
    'questions/24/01KSJY2ZDMFTYWT35KZ5QBHHX6.png' => 'figure-4.png',
    'questions/24/01KSK0WE4V6NJRMCZECPAXA1PX.png' => 'choices-24.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 20:51:08'
            ],
            [
                'id' => 25,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 3,
                'skill_id' => 11,
                'question_type' => 'multiple_choice_math',
                'question' => 'Draw a line through points 𝐴 and 𝐵 in Figure 4. Which of the following ordered pairs represent all the points that are on this line?',
                'answers' => json_encode([
    'e'
]),
                'attachments' => json_encode([
    'questions/25/01KSJY3GQ559SX1565FPC0SVMP.png',
    'questions/25/01KSK0WSVDXJ5Z490Z7YE93GQ7.png'
]),
                'attachment_file_names' => json_encode([
    'questions/25/01KSJY3GQ559SX1565FPC0SVMP.png' => 'figure-4.png',
    'questions/25/01KSK0WSVDXJ5Z490Z7YE93GQ7.png' => 'choices-25.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 09:14:18'
            ],
            [
                'id' => 26,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 13,
                'question_type' => 'identification_math',
                'question' => 'In Figure 4, connecting the points 𝐴, 𝐵 and 𝐶 will form a triangle, called triangle 𝐴𝐵𝐶. What is the area of triangle 𝐴𝐵𝐶? Show your method for getting the area.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/26/01KSJY3YFYF2HXG9W28X2Z6RKK.png'
]),
                'attachment_file_names' => json_encode([
    'questions/26/01KSJY3YFYF2HXG9W28X2Z6RKK.png' => 'figure-4.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 20:02:48'
            ],
            [
                'id' => 27,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 15,
                'question_type' => 'identification',
                'question' => 'A point represents position. Suppose in Figure 4, point 𝐴 represents the position of your house, point 𝐵 represents the position of your school and point 𝐶 represents the position of the barangay hall. There is a straight road that you can take to the school and the barangay hall from your house. Which is the shorter walk from your house, going to the school or to the barangay hall?',
                'answers' => null,
                'attachments' => json_encode([
    'questions/27/01KSJY4G4XWASQAEY5P8MW6PAT.png'
]),
                'attachment_file_names' => json_encode([
    'questions/27/01KSJY4G4XWASQAEY5P8MW6PAT.png' => 'figure-4.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 20:03:07'
            ],
            [
                'id' => 28,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 15,
                'question_type' => 'identification_math',
                'question' => 'Show or explain how you determined your answer in item 27.',
                'answers' => null,
                'attachments' => null,
                'attachment_file_names' => null,
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 19:00:23'
            ],
            [
                'id' => 29,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 20,
                'question_type' => 'identification',
                'question' => 'If 𝒓 is an integer, select all possible values that can be represented by 2𝑟 − 1. [NOTE: present answers as a set (e.g. {-5, -27, -82})]',
                'answers' => json_encode([
    '{-5, -27, 99}'
]),
                'attachments' => json_encode([
    'questions/29/01KSK13QEGPAN5S544ZF611AWY.png'
]),
                'attachment_file_names' => json_encode([
    'questions/29/01KSK13QEGPAN5S544ZF611AWY.png' => 'choices-29.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:42:23'
            ],
            [
                'id' => 30,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 20,
                'question_type' => 'multiple_choice_math',
                'question' => 'At a fruit stand, apples are priced at 3 for Php100. Which of the following expressions can be used to find the amount to be paid (cost) for any number of apples? Select the correct answers.',
                'answers' => json_encode([
    'd',
    'e'
]),
                'attachments' => json_encode([
    'questions/30/01KSK144Z2NS8R2D7K2BCF7EP7.png'
]),
                'attachment_file_names' => json_encode([
    'questions/30/01KSK144Z2NS8R2D7K2BCF7EP7.png' => 'choices-30.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 09:16:18'
            ],
            [
                'id' => 31,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 21,
                'question_type' => 'identification_math',
                'question' => 'Write two possible values for 𝑎 and 𝑏 that will make the equation in Box 2 true.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/31/01KSJY5S1PH8T2E2XCC43Q56CS.png'
]),
                'attachment_file_names' => json_encode([
    'questions/31/01KSJY5S1PH8T2E2XCC43Q56CS.png' => 'box-2.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-26 20:03:48'
            ],
            [
                'id' => 32,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 6,
                'skill_id' => 21,
                'question_type' => 'multiple_choice_math',
                'question' => 'Which statement is always true about 𝑎 and 𝑏? \\lbrack Refer to Box 2\\rbrack',
                'answers' => json_encode([
    'c'
]),
                'attachments' => json_encode([
    'questions/32/01KSJY636WPDYGE8ZK7ERFWE5R.png',
    'questions/32/01KSK164PMS77ADX8AAK51C208.png'
]),
                'attachment_file_names' => json_encode([
    'questions/32/01KSJY636WPDYGE8ZK7ERFWE5R.png' => 'box-2.png',
    'questions/32/01KSK164PMS77ADX8AAK51C208.png' => 'choices-32.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:23',
                'updated_at' => '2026-05-27 08:44:09'
            ],
            [
                'id' => 33,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 22,
                'question_type' => 'multiple_choice',
                'question' => 'What reason can we use to transform equation ① into equation ②?',
                'answers' => json_encode([
    'c'
]),
                'attachments' => json_encode([
    'questions/33/01KSJYBJD3EZG2SXPA7812DF8D.png',
    'questions/33/01KSJYBJD8SA3DHB3NZN6KBX8A.png'
]),
                'attachment_file_names' => json_encode([
    'questions/33/01KSJYBJD3EZG2SXPA7812DF8D.png' => 'equations-33.png',
    'questions/33/01KSJYBJD8SA3DHB3NZN6KBX8A.png' => 'choices-33.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 08:45:03'
            ],
            [
                'id' => 34,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 23,
                'question_type' => 'identification',
                'question' => 'How much does it cost to rent the tricycle for 5 days? [Refer to Figure 5]',
                'answers' => json_encode([
    'P1250'
]),
                'attachments' => json_encode([
    'questions/34/01KSJY78Y6ZPY29ZMDMDY3K1AT.png'
]),
                'attachment_file_names' => json_encode([
    'questions/34/01KSJY78Y6ZPY29ZMDMDY3K1AT.png' => 'figure-5.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 08:45:42'
            ],
            [
                'id' => 35,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 24,
                'question_type' => 'multiple_choice',
                'question' => 'What does the number 250 in the formula represent? \\lbrack Refer to Figure 5\\rbrack\\lbrack NOTE: for multiple answers, separate by comma (e.g. a, b, c)\\rbrack',
                'answers' => json_encode([
    'c'
]),
                'attachments' => json_encode([
    'questions/35/01KSJYVJFJE9TJAC40KS4M87QF.png',
    'questions/35/01KSK17QAE7RMAPPT78QH1E0WD.png'
]),
                'attachment_file_names' => json_encode([
    'questions/35/01KSJYVJFJE9TJAC40KS4M87QF.png' => 'figure-5.png',
    'questions/35/01KSK17QAE7RMAPPT78QH1E0WD.png' => 'choices-35.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 08:48:23'
            ],
            [
                'id' => 36,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 24,
                'question_type' => 'identification',
                'question' => 'In Figure 5, what does the number 200 in the formula represent?',
                'answers' => null,
                'attachments' => json_encode([
    'questions/36/01KSJYVZFTJRCHFZZCRFSERZWB.png'
]),
                'attachment_file_names' => json_encode([
    'questions/36/01KSJYVZFTJRCHFZZCRFSERZWB.png' => 'figure-5.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-26 20:15:56'
            ],
            [
                'id' => 37,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 7,
                'skill_id' => 25,
                'question_type' => 'multiple_choice',
                'question' => 'What aspect of the graph in Figure 5 represents the 200 in the formula?',
                'answers' => json_encode([
    'c'
]),
                'attachments' => json_encode([
    'questions/37/01KSJYWDGAHSYKZ463KS94ET0T.png',
    'questions/37/01KSK185AY7HXS9PQ7TTAARDA2.png'
]),
                'attachment_file_names' => json_encode([
    'questions/37/01KSJYWDGAHSYKZ463KS94ET0T.png' => 'figure-5.png',
    'questions/37/01KSK185AY7HXS9PQ7TTAARDA2.png' => 'choices-37.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 08:49:14'
            ],
            [
                'id' => 38,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 14,
                'question_type' => 'multiple_choice_math',
                'question' => 'In Figure 6, if the measure of angle P is 30 degrees (that is, p = 30), which of the following are possible values for q and r? Choose 2 that are correct among the choices. Note that the triangle is not drawn to scale.',
                'answers' => json_encode([
    'a',
    'e'
]),
                'attachments' => json_encode([
    'questions/38/01KSJYX4MRBZ404MFWHMWTEG17.png',
    'questions/38/01KSK1BH06EA1D09D8PS61KTPW.png'
]),
                'attachment_file_names' => json_encode([
    'questions/38/01KSJYX4MRBZ404MFWHMWTEG17.png' => 'figure-6.png',
    'questions/38/01KSK1BH06EA1D09D8PS61KTPW.png' => 'choices-38.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 09:18:04'
            ],
            [
                'id' => 39,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 14,
                'question_type' => 'multiple_choice',
                'question' => 'In Figure 6, if the measure of angle R is 60 degrees (that is, r = 60) and the measure of the exterior angle at Q is 130, what is true about the values of p and q? Choose at least one true statement about p and q. NOTE: The exterior angle of a triangle forms a 180-degree angle with the adjacent interior angle.',
                'answers' => json_encode([
    'c',
    'e'
]),
                'attachments' => json_encode([
    'questions/39/01KSJYXP8EQWEZG3VWDBCYBJ2E.png',
    'questions/39/01KSK1DASJD0KPGWFPXJ185CQH.png'
]),
                'attachment_file_names' => json_encode([
    'questions/39/01KSJYXP8EQWEZG3VWDBCYBJ2E.png' => 'figure-6.png',
    'questions/39/01KSK1DASJD0KPGWFPXJ185CQH.png' => 'choices-39.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 09:20:37'
            ],
            [
                'id' => 40,
                'grade_lvl_id' => 3,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 14,
                'question_type' => 'multiple_choice',
                'question' => 'Which of the following statements about the properties of triangles will help determine the values of p and q in the preceding question? Choose those that are applicable. [Refer to Figure 6]',
                'answers' => json_encode([
    'c',
    'd'
]),
                'attachments' => json_encode([
    'questions/40/01KSJYY21H2SG19FY0SC95R06Z.png',
    'questions/40/01KSK1E3C2ZFYFFE59G8F72GGM.png'
]),
                'attachment_file_names' => json_encode([
    'questions/40/01KSJYY21H2SG19FY0SC95R06Z.png' => 'figure-6.png',
    'questions/40/01KSK1E3C2ZFYFFE59G8F72GGM.png' => 'choices-40.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 09:21:08'
            ],
            [
                'id' => 41,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 15,
                'question_type' => 'multiple_choice',
                'question' => 'What are the lengths of the other two sides of the triangular dog house? \\lbrack Refer to Figure 7\\rbrack',
                'answers' => json_encode([
    'a'
]),
                'attachments' => json_encode([
    'questions/41/01KSJYYPN77MJGS931MZ02PYTR.png',
    'questions/41/01KSK1FZC6CZC46TE09TK1A1TF.png'
]),
                'attachment_file_names' => json_encode([
    'questions/41/01KSJYYPN77MJGS931MZ02PYTR.png' => 'figure-7.png',
    'questions/41/01KSK1FZC6CZC46TE09TK1A1TF.png' => 'choices-41.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 08:59:38'
            ],
            [
                'id' => 42,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 15,
                'question_type' => 'identification',
                'question' => 'In Figure 7, are the sides of the triangular dog house proportional to the sides of the triangular toy storage? Show your solution or explain your answer.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/42/01KSJYZ3X4F9DA2JM51J36KRXM.png'
]),
                'attachment_file_names' => json_encode([
    'questions/42/01KSJYZ3X4F9DA2JM51J36KRXM.png' => 'figure-7.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-26 20:17:39'
            ],
            [
                'id' => 43,
                'grade_lvl_id' => 4,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 4,
                'skill_id' => 15,
                'question_type' => 'multiple_choice',
                'question' => 'The base of the toy storage measures 25 centimeters. What are the lengths of its other two sides? \\lbrack Refer to Figure 7\\rbrack \\lbrack NOTE: for multiple answers, separate by comma e.g. (a, b, c)\\rbrack',
                'answers' => json_encode([
    'a'
]),
                'attachments' => json_encode([
    'questions/43/01KSJYZKVENRGQ6PS6DQ396PGT.png',
    'questions/43/01KSK1GMJPP4D1E8PB4EGP82GV.png'
]),
                'attachment_file_names' => json_encode([
    'questions/43/01KSJYZKVENRGQ6PS6DQ396PGT.png' => 'figure-7.png',
    'questions/43/01KSK1GMJPP4D1E8PB4EGP82GV.png' => 'choices-43.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 08:59:26'
            ],
            [
                'id' => 44,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 16,
                'question_type' => 'identification_math',
                'question' => 'What is the area of the sidewalk in square meters surrounding the pool? Show your solution. [Refer to Figure 8] Use pi = 3.14.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/44/01KSJYZZGYE9R093XH8MZ07KRK.png'
]),
                'attachment_file_names' => json_encode([
    'questions/44/01KSJYZZGYE9R093XH8MZ07KRK.png' => 'figure-8.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-26 20:18:07'
            ],
            [
                'id' => 45,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 18,
                'question_type' => 'multiple_choice_math',
                'question' => 'The park management decides to divide the pool into two equal parts. One part will be designated for adults and has a depth of 1.5 meters, while the other part will be designated for children and has a depth of 0.6 meters. Which of the following will give the total volume of water in the pool? \\lbrack Refer to Figure 9\\rbrack \\lbrack NOTE: for multiple answers, separate by comma (a, b, c)\\rbrack',
                'answers' => json_encode([
    'd'
]),
                'attachments' => json_encode([
    'questions/45/01KSJZ0DM8V0N7ZFH1VDGQ3PVP.png',
    'questions/45/01KSK1J3D0ARNDKX3BXWBD98F0.png'
]),
                'attachment_file_names' => json_encode([
    'questions/45/01KSJZ0DM8V0N7ZFH1VDGQ3PVP.png' => 'figure-9.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 09:00:39'
            ],
            [
                'id' => 46,
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 17,
                'question_type' => 'identification_math',
                'question' => 'The wheel in Figure 10 is rolled exactly 5 times. Show how you can compute the distance travelled by the wheel.',
                'answers' => null,
                'attachments' => json_encode([
    'questions/46/01KSJZ1918V1QCEC7X0Y99TC3Y.png'
]),
                'attachment_file_names' => json_encode([
    'questions/46/01KSJZ1918V1QCEC7X0Y99TC3Y.png' => 'figure-10.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-26 20:18:50'
            ],
            [
                'id' => 47,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 3,
                'topic_id' => 5,
                'skill_id' => 19,
                'question_type' => 'identification',
                'question' => 'How many degrees did the wheel\'s pin rotate after 5 rolls? [Refer to Figure 10]',
                'answers' => json_encode([
    '1800 degrees'
]),
                'attachments' => json_encode([
    'questions/47/01KSJZ1R66302JJDGP0B7TSV03.png'
]),
                'attachment_file_names' => json_encode([
    'questions/47/01KSJZ1R66302JJDGP0B7TSV03.png' => 'figure-10.png'
]),
                'assessment_type' => 'initial',
                'created_at' => '2026-05-26 19:00:24',
                'updated_at' => '2026-05-27 09:02:21'
            ]
        ]);
    }
}