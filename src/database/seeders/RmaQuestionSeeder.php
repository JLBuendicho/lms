<?php

namespace Database\Seeders;

use App\Models\Domains;
use App\Models\GradeLvls;
use App\Models\Questions;
use App\Models\Skills;
use App\Models\Subjects;
use App\Models\Topics;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RmaQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                7,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'GEMDAS',
                'Your classmate said that each of the four expressions in Box 1 is equivalent to 1. Verify what your classmate said by showing your computation for the number expression 4 × 4 − 5 × 3.',
            ],
            [
                7,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Expression From Patterns',
                'What must be the next number expression to 5 × 5 − 6 × 4 in Box 1?',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Algebraic Representation',
                'Which of the following algebraic expressions represents the set of number expressions in Box 1?',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Algebraic Representation',
                'Explain or show why you think you have chosen the correct algebraic expressions for the set of number expressions in Box 1.',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Algebraic Representation',
                'What does 𝑛 represent in your chosen expression in item 3?',
            ],
            [
                7,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Exponents',
                'Show that 1024 is a power of 2. [Refer to Table 1]',
            ],
            [
                7,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Exponents',
                'Write the exponential form of 1024',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Exponents',
                'Find a number that is a power of 2 that meets BOTH of these conditions: The number is a multiple of 16, The number is also more than 50 but less than 200.',
            ],
            [
                7,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Decimals',
                'Is there a number between 0.998 and 0.999? If YES, give one example. If NO, explain why you think so.',
            ],
            [
                7,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Decimals',
                'Show how you will subtract 0.998 from 0.999.',
            ],
            [
                7,
                'Mathematics',
                'Algebra',
                'Number Expressions',
                'Fractions',
                'Is there a fraction that is greater than 𝟑/𝟒 but less than 1? If YES, give one example. If NO, explain why you think so.',
            ],
            [
                7,
                'Mathematics',
                'Statistics and Probability',
                'Data',
                'Interpreting Charts',
                'How many students had an overall academic grade below 84? [Refer to Figure 1]',
            ],
            [
                7,
                'Mathematics',
                'Statistics and Probability',
                'Data',
                'Interpreting Charts',
                'Explain why you think your answer in item 12 is correct based on the information shown in the graph in Figure 1.',
            ],
            [
                7,
                'Mathematics',
                'Statistics and Probability',
                'Data',
                'Interpreting Charts',
                'Which of the following can be a correct interpretation of the data presented in the graph in Figure 1?',
            ],
            [
                9,
                'Mathematics',
                'Statistics and Probability',
                'Data',
                'Variability',
                'Based on the graph in Figure 2, which of the two puroks shows more diversity in monthly family income? Explain or justify your answer.',
            ],
            [
                9,
                'Mathematics',
                'Statistics and Probability',
                'Data',
                'Variability',
                'The average monthly income of the families in Purok 1 and Purok 2 are equal. Should both purok be given the same amount of financial aid? What information in the graph in Figure 2 did you base your decision on?',
            ],
            [
                7,
                'Mathematics',
                'Statistics and Probability',
                'Data',
                'Interpreting Charts',
                'How many students participated in the music activity?',
            ],
            [
                7,
                'Mathematics',
                'Statistics and Probability',
                'Data',
                'Interpreting Charts',
                'How many students did not participate in any of the two activities? ',
            ],
            [
                9,
                'Mathematics',
                'Statistics and Probability',
                'Data',
                'Determining Probability',
                'What is the probability of selecting a student who participated in both music and sports activities?',
            ],
            [
                7,
                'Mathematics',
                'Statistics and Probability',
                'Data',
                'Interpreting Charts',
                'Write a question that can be answered using the information in Table 2.',
            ],
            [
                8,
                'Mathematics',
                'Geometry',
                'Coordinates',
                'Numberlines',
                'What is the position of point 𝐹 in Figure 3?',
            ],
            [
                7,
                'Mathematics',
                'Geometry',
                'Coordinates',
                'Numberlines',
                'What is the position of point 𝐺 in Figure 3?',
            ],
            [
                8,
                'Mathematics',
                'Geometry',
                'Coordinates',
                'Cartesian Plane',
                'What are the coordinates of Point 𝐶 in Figure 4?',
            ],
            [
                8,
                'Mathematics',
                'Geometry',
                'Coordinates',
                'Distance Formula',
                'A line is drawn passing through points 𝐵 and 𝐶 in Figure 4. Select two ordered pairs that represent the coordinates of points that are also in this line.,',
            ],
            [
                8,
                'Mathematics',
                'Geometry',
                'Coordinates',
                'Cartesian Plane',
                'Draw a line through points 𝐴 and 𝐵 in Figure 4. Which of the following ordered pairs represent all the points that are on this line?',
            ],
            [
                7,
                'Mathematics',
                'Geometry',
                'Triangles',
                'Area of Triangles',
                'In Figure 4, connecting the points 𝐴, 𝐵 and 𝐶 will form a triangle, called triangle 𝐴𝐵𝐶. What is the area of triangle 𝐴𝐵𝐶? Show your method for getting the area.',
            ],
            [
                7,
                'Mathematics',
                'Geometry',
                'Triangles',
                'Sides in a Triangle',
                'A point represents position. Suppose in Figure 4, point 𝐴 represents the position of your house, point 𝐵 represents the position of your school and point 𝐶 represents the position of the barangay hall. There is a straight road that you can take to the school and the barangay hall from your house. Which is the shorter walk from your house, going to the school or to the barangay hall?',
            ],
            [
                7,
                'Mathematics',
                'Geometry',
                'Triangles',
                'Sides in a Triangle',
                'Show or explain how you determined your answer in item 27. ',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Variables',
                'Algebraic Expressions',
                'If 𝒓 is an integer, select all possible values that can be represented by 2𝑟 − 1.',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Variables',
                'Algebraic Expressions',
                'At a fruit stand, apples are priced at 3 for Php100. Which of the following expressions can be used to find the amount to be paid (cost) for any number of apples? Select the correct answers.',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Variables',
                'Equations with Unknowns',
                'Write two possible values for 𝑎 and 𝑏 that will make the equation in Box 2 true.',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Variables',
                'Equations with Unknowns',
                'Which statement is always true about 𝑎 and 𝑏? [Refer to Box 2]',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Equations and Graphs',
                'Properties of Equality',
                'What reason can we use to transform equation ① into equation ②?',
            ],
            [
                8,
                'Mathematics',
                'Algebra',
                'Equations and Graphs',
                'Linear Equations',
                'How much does it cost to rent the tricycle for 5 days? [Refer to Figure 5]',
            ],
            [
                9,
                'Mathematics',
                'Algebra',
                'Equations and Graphs',
                'Formulas',
                'What does the number 250 in the formula represent? [Refer to Figure 5]',
            ],
            [
                9,
                'Mathematics',
                'Algebra',
                'Equations and Graphs',
                'Formulas',
                'In Figure 5, what does the number 200 in the formula represent?',
            ],
            [
                9,
                'Mathematics',
                'Algebra',
                'Equations and Graphs',
                'Aspects of Graphs',
                'What aspect of the graph in Figure 5 represents the 200 in the formula?',
            ],
            [
                8,
                'Mathematics',
                'Geometry',
                'Triangles',
                'Angles in a Triangle',
                'In Figure 6, if the measure of angle P is 30 degrees (that is, p = 30), which of the following are possible values for q and r? Choose 2 that are correct among the choices. Note that the triangle is not drawn to scale.',
            ],
            [
                7,
                'Mathematics',
                'Geometry',
                'Triangles',
                'Angles in a Triangle',
                'In Figure 6, if the measure of angle R is 60 degrees (that is, r = 60) and the measure of the exterior angle at Q is 130, what is true about the values of p and q? Choose at least one true statement about p and q. NOTE: The exterior angle of a triangle forms a 180-degree angle with the adjacent interior angle.',
            ],
            [
                9,
                'Mathematics',
                'Geometry',
                'Triangles',
                'Angles in a Triangle',
                'Which of the following statements about the properties of triangles will help determine the values of p and q in the preceding question? Choose those that are applicable. [Refer to Figure 6]',
            ],
            [
                7,
                'Mathematics',
                'Geometry',
                'Triangles',
                'Sides in a Triangle',
                'What are the lengths of the other two sides of the triangular dog house? [Refer to Figure 7]',
            ],
            [
                10,
                'Mathematics',
                'Geometry',
                'Triangles',
                'Sides in a Triangle',
                'In Figure 7, are the sides of the triangular dog house proportional to the sides of the triangular toy storage? Show your solution or explain your answer.',
            ],
            [
                10,
                'Mathematics',
                'Geometry',
                'Triangles',
                'Sides in a Triangle',
                'The base of the toy storage measures 25 centimeters. What are the lengths of its other two sides? [Refer to Figure 7]',
            ],
            [
                7,
                'Mathematics',
                'Geometry',
                'Circles',
                'Area of Circles',
                'What is the area of the sidewalk in square meters surrounding the pool? Show your solution. [Refer to Figure 8] Use pi = 3.14.',
            ],
            [
                8,
                'Mathematics',
                'Geometry',
                'Circles',
                'Volume of Cylinders',
                'The park management decides to divide the pool into two equal parts. One part will be designated for adults and has a depth of 1.5 meters, while the other part will be designated for children and has a depth of 0.6 meters. Which of the following will give the total volume of water in the pool? [Refer to Figure 9]',
            ],
            [
                7,
                'Mathematics',
                'Geometry',
                'Circles',
                'Circumference of Circles',
                'The wheel in Figure 10 is rolled exactly 5 times. Show how you can compute the distance travelled by the wheel.',
            ],
            [
                8,
                'Mathematics',
                'Geometry',
                'Circles',
                'Rotation',
                'How many degrees did the wheel’s pin rotate after 5 rolls? [Refer to Figure 10]',
            ],
        ];

        foreach ($questions as $question) {
            [
                $gradeLvl,
                $subjectName,
                $domainName,
                $topicName,
                $skillName,
                $questionText
            ] = $question;

            $gradeLvlId = GradeLvls::where('grade_lvl', $gradeLvl)->value('id');
            $subjectId = Subjects::where('name', $subjectName)->value('id');
            $domainId = Domains::where('name', $domainName)->value('id');
            $topicId = Topics::where('name', $topicName)->value('id');
            $skillId = Skills::where('name', $skillName)->value('id');

            Questions::create([
                'grade_lvl_id' => $gradeLvlId,
                'subject_id' => $subjectId,
                'domain_id' => $domainId,
                'topic_id' => $topicId,
                'skill_id' => $skillId,
                'question'=> $questionText,
            ]);
        }
    }
}
