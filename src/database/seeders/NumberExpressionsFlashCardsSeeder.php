<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NumberExpressionsFlashCardsSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            1 => 'GEMDAS',
            2 => 'Expression From Patterns',
            3 => 'Exponents',
            4 => 'Decimals',
            5 => 'Fractions',
            6 => 'Algebraic Representation',
        ];

        $cards = [
            /*
            |--------------------------------------------------------------------------
            | Skill 1 — GEMDAS (20 cards)
            |--------------------------------------------------------------------------
            */
            1 => [
                'What is the value of <strong>8 + 3 × 4</strong>?',
                '<p><strong>20</strong></p><p>Multiplication comes before addition:</p><p>3 × 4 = 12</p><p>8 + 12 = <strong>20</strong></p>'
            ],
            2 => [
                'What is the value of <strong>(8 + 3) × 4</strong>?',
                '<p><strong>44</strong></p><p>Evaluate inside the parentheses first:</p><p>8 + 3 = 11</p><p>11 × 4 = <strong>44</strong></p>'
            ],
            3 => [
                'Evaluate <strong>18 − 6 ÷ 3</strong>.',
                '<p><strong>16</strong></p><p>Division comes before subtraction:</p><p>6 ÷ 3 = 2</p><p>18 − 2 = <strong>16</strong></p>'
            ],
            4 => [
                'Evaluate <strong>5² + 6</strong>.',
                '<p><strong>31</strong></p><p>Evaluate the exponent first:</p><p>5² = 25</p><p>25 + 6 = <strong>31</strong></p>'
            ],
            5 => [
                'Evaluate <strong>24 ÷ 4 × 3</strong>.',
                '<p><strong>18</strong></p><p>Multiplication and division have the same priority, so work from left to right:</p><p>24 ÷ 4 = 6</p><p>6 × 3 = <strong>18</strong></p>'
            ],
            6 => [
                'Evaluate <strong>20 − 3²</strong>.',
                '<p><strong>11</strong></p><p>Evaluate the exponent first:</p><p>3² = 9</p><p>20 − 9 = <strong>11</strong></p>'
            ],
            7 => [
                'Evaluate <strong>4(3 + 2) − 6</strong>.',
                '<p><strong>14</strong></p><p>Parentheses first:</p><p>3 + 2 = 5</p><p>4 × 5 − 6 = 20 − 6 = <strong>14</strong></p>'
            ],
            8 => [
                'Evaluate <strong>30 ÷ (2 + 3)</strong>.',
                '<p><strong>6</strong></p><p>2 + 3 = 5</p><p>30 ÷ 5 = <strong>6</strong></p>'
            ],
            9 => [
                'Evaluate <strong>7 + 2³ × 2</strong>.',
                '<p><strong>23</strong></p><p>2³ = 8</p><p>8 × 2 = 16</p><p>7 + 16 = <strong>23</strong></p>'
            ],
            10 => [
                'Evaluate <strong>(15 − 5)² ÷ 10</strong>.',
                '<p><strong>10</strong></p><p>15 − 5 = 10</p><p>10² = 100</p><p>100 ÷ 10 = <strong>10</strong></p>'
            ],
            11 => [
                'Evaluate <strong>40 − 8 × 3 + 2</strong>.',
                '<p><strong>18</strong></p><p>8 × 3 = 24</p><p>40 − 24 + 2 = <strong>18</strong></p>'
            ],
            12 => [
                'Evaluate <strong>36 ÷ 6 + 4 × 2</strong>.',
                '<p><strong>14</strong></p><p>36 ÷ 6 = 6</p><p>4 × 2 = 8</p><p>6 + 8 = <strong>14</strong></p>'
            ],
            13 => [
                'Evaluate <strong>2(5² − 9)</strong>.',
                '<p><strong>32</strong></p><p>5² = 25</p><p>25 − 9 = 16</p><p>2 × 16 = <strong>32</strong></p>'
            ],
            14 => [
                'Evaluate <strong>50 ÷ 5²</strong>.',
                '<p><strong>2</strong></p><p>5² = 25</p><p>50 ÷ 25 = <strong>2</strong></p>'
            ],
            15 => [
                'Evaluate <strong>12 + (18 ÷ 3) × 2</strong>.',
                '<p><strong>24</strong></p><p>18 ÷ 3 = 6</p><p>6 × 2 = 12</p><p>12 + 12 = <strong>24</strong></p>'
            ],
            16 => [
                'Evaluate <strong>3² + 4²</strong>.',
                '<p><strong>25</strong></p><p>3² = 9 and 4² = 16</p><p>9 + 16 = <strong>25</strong></p>'
            ],
            17 => [
                'Evaluate <strong>(7 + 5) ÷ 3 + 2</strong>.',
                '<p><strong>6</strong></p><p>7 + 5 = 12</p><p>12 ÷ 3 = 4</p><p>4 + 2 = <strong>6</strong></p>'
            ],
            18 => [
                'Evaluate <strong>6 × (10 − 7)²</strong>.',
                '<p><strong>54</strong></p><p>10 − 7 = 3</p><p>3² = 9</p><p>6 × 9 = <strong>54</strong></p>'
            ],
            19 => [
                'Evaluate <strong>100 − [4(8 + 2)]</strong>.',
                '<p><strong>60</strong></p><p>8 + 2 = 10</p><p>4 × 10 = 40</p><p>100 − 40 = <strong>60</strong></p>'
            ],
            20 => [
                'Evaluate <strong>2³ + 3 × 4 − 5</strong>.',
                '<p><strong>15</strong></p><p>2³ = 8</p><p>3 × 4 = 12</p><p>8 + 12 − 5 = <strong>15</strong></p>'
            ],

            /*
            |--------------------------------------------------------------------------
            | Skill 2 — Expression From Patterns (20 cards)
            |--------------------------------------------------------------------------
            */
            21 => [
                'The pattern is <strong>3, 6, 9, 12, ...</strong>. What expression gives the nth term?',
                '<p><strong>3n</strong></p><p>Each term is 3 times its position.</p><p>n = 1 → 3</p><p>n = 2 → 6</p><p>n = 3 → 9</p>'
            ],
            22 => [
                'The pattern is <strong>5, 10, 15, 20, ...</strong>. Write an expression for the nth term.',
                '<p><strong>5n</strong></p><p>The common difference is 5 and the first term is 5.</p>'
            ],
            23 => [
                'The pattern is <strong>2, 5, 8, 11, ...</strong>. What is the nth-term expression?',
                '<p><strong>3n − 1</strong></p><p>For n = 1: 3(1) − 1 = 2.</p><p>For n = 2: 3(2) − 1 = 5.</p>'
            ],
            24 => [
                'The pattern is <strong>4, 7, 10, 13, ...</strong>. What is the nth term?',
                '<p><strong>3n + 1</strong></p><p>The common difference is 3.</p><p>3(1) + 1 = 4.</p>'
            ],
            25 => [
                'The pattern is <strong>10, 15, 20, 25, ...</strong>. What expression represents the nth term?',
                '<p><strong>5n + 5</strong></p><p>At n = 1: 5(1) + 5 = 10.</p>'
            ],
            26 => [
                'The pattern is <strong>1, 4, 7, 10, ...</strong>. What is the nth-term expression?',
                '<p><strong>3n − 2</strong></p><p>At n = 1: 3(1) − 2 = 1.</p>'
            ],
            27 => [
                'The pattern is <strong>7, 11, 15, 19, ...</strong>. What expression gives the nth term?',
                '<p><strong>4n + 3</strong></p><p>The common difference is 4.</p><p>4(1) + 3 = 7.</p>'
            ],
            28 => [
                'The pattern is <strong>20, 17, 14, 11, ...</strong>. Find the nth-term expression.',
                '<p><strong>23 − 3n</strong></p><p>The common difference is −3.</p><p>23 − 3(1) = 20.</p>'
            ],
            29 => [
                'A pattern begins <strong>6, 10, 14, 18, ...</strong>. What is the 10th term?',
                '<p><strong>42</strong></p><p>The expression is 4n + 2.</p><p>4(10) + 2 = <strong>42</strong>.</p>'
            ],
            30 => [
                'The nth term is <strong>2n + 5</strong>. What are the first four terms?',
                '<p><strong>7, 9, 11, 13</strong></p><p>Substitute n = 1, 2, 3, and 4.</p>'
            ],
            31 => [
                'The nth term is <strong>5n − 2</strong>. What is the 8th term?',
                '<p><strong>38</strong></p><p>5(8) − 2 = 40 − 2 = <strong>38</strong>.</p>'
            ],
            32 => [
                'The pattern is <strong>12, 16, 20, 24, ...</strong>. What is the 15th term?',
                '<p><strong>68</strong></p><p>The nth term is 4n + 8.</p><p>4(15) + 8 = <strong>68</strong>.</p>'
            ],
            33 => [
                'A sequence has the nth term <strong>7n</strong>. What is its 12th term?',
                '<p><strong>84</strong></p><p>7(12) = <strong>84</strong>.</p>'
            ],
            34 => [
                'A pattern is <strong>30, 27, 24, 21, ...</strong>. What is its nth-term expression?',
                '<p><strong>33 − 3n</strong></p><p>The common difference is −3.</p>'
            ],
            35 => [
                'The nth term is <strong>n + 9</strong>. What are the first five terms?',
                '<p><strong>10, 11, 12, 13, 14</strong></p>'
            ],
            36 => [
                'The pattern is <strong>8, 13, 18, 23, ...</strong>. What is the nth term?',
                '<p><strong>5n + 3</strong></p><p>At n = 1: 5 + 3 = 8.</p>'
            ],
            37 => [
                'The pattern is <strong>2, 6, 10, 14, ...</strong>. What is the 20th term?',
                '<p><strong>78</strong></p><p>The nth term is 4n − 2.</p><p>4(20) − 2 = <strong>78</strong>.</p>'
            ],
            38 => [
                'A sequence has terms <strong>9, 14, 19, 24, ...</strong>. What is the common difference?',
                '<p><strong>5</strong></p><p>Each term increases by 5.</p>'
            ],
            39 => [
                'The nth term is <strong>10n − 1</strong>. What is the 6th term?',
                '<p><strong>59</strong></p><p>10(6) − 1 = <strong>59</strong>.</p>'
            ],
            40 => [
                'The pattern is <strong>11, 18, 25, 32, ...</strong>. Find the nth-term expression.',
                '<p><strong>7n + 4</strong></p><p>The common difference is 7.</p><p>7(1) + 4 = 11.</p>'
            ],

            /*
            |--------------------------------------------------------------------------
            | Skill 3 — Exponents (20 cards)
            |--------------------------------------------------------------------------
            */
            41 => [
                'What does <strong>4³</strong> mean?',
                '<p><strong>4 × 4 × 4</strong></p><p>The exponent 3 tells us to multiply three factors of 4.</p>'
            ],
            42 => [
                'Evaluate <strong>2⁵</strong>.',
                '<p><strong>32</strong></p><p>2⁵ = 2 × 2 × 2 × 2 × 2 = <strong>32</strong>.</p>'
            ],
            43 => [
                'Evaluate <strong>10²</strong>.',
                '<p><strong>100</strong></p><p>10² = 10 × 10 = <strong>100</strong>.</p>'
            ],
            44 => [
                'Evaluate <strong>3⁴</strong>.',
                '<p><strong>81</strong></p><p>3⁴ = 3 × 3 × 3 × 3 = <strong>81</strong>.</p>'
            ],
            45 => [
                'Evaluate <strong>5³</strong>.',
                '<p><strong>125</strong></p><p>5 × 5 × 5 = <strong>125</strong>.</p>'
            ],
            46 => [
                'What is the value of <strong>7²</strong>?',
                '<p><strong>49</strong></p>'
            ],
            47 => [
                'Simplify <strong>2³ × 2²</strong>.',
                '<p><strong>2⁵ = 32</strong></p><p>When multiplying powers with the same base, add the exponents:</p><p>2³ × 2² = 2⁵ = 32.</p>'
            ],
            48 => [
                'Simplify <strong>5⁴ ÷ 5²</strong>.',
                '<p><strong>5² = 25</strong></p><p>When dividing powers with the same base, subtract the exponents:</p><p>5⁴ ÷ 5² = 5².</p>'
            ],
            49 => [
                'What is <strong>x² × x³</strong> simplified?',
                '<p><strong>x⁵</strong></p><p>Add the exponents because the bases are the same.</p>'
            ],
            50 => [
                'Simplify <strong>y⁶ ÷ y²</strong>.',
                '<p><strong>y⁴</strong></p><p>6 − 2 = 4.</p>'
            ],
            51 => [
                'Evaluate <strong>(2³)²</strong>.',
                '<p><strong>64</strong></p><p>(2³)² = 2⁶ = 64.</p>'
            ],
            52 => [
                'Simplify <strong>(x²)³</strong>.',
                '<p><strong>x⁶</strong></p><p>Multiply the exponents: 2 × 3 = 6.</p>'
            ],
            53 => [
                'What is the value of <strong>6⁰</strong>?',
                '<p><strong>1</strong></p><p>Any nonzero number raised to the zero power equals 1.</p>'
            ],
            54 => [
                'What is <strong>a¹</strong>?',
                '<p><strong>a</strong></p><p>A number or variable raised to the first power remains unchanged.</p>'
            ],
            55 => [
                'Evaluate <strong>4² + 3²</strong>.',
                '<p><strong>25</strong></p><p>4² = 16 and 3² = 9.</p><p>16 + 9 = <strong>25</strong>.</p>'
            ],
            56 => [
                'Evaluate <strong>2⁴ + 5</strong>.',
                '<p><strong>21</strong></p><p>2⁴ = 16.</p><p>16 + 5 = <strong>21</strong>.</p>'
            ],
            57 => [
                'Simplify <strong>3x² × 2x³</strong>.',
                '<p><strong>6x⁵</strong></p><p>Multiply coefficients: 3 × 2 = 6.</p><p>Add exponents: x² × x³ = x⁵.</p>'
            ],
            58 => [
                'Simplify <strong>8a⁵ ÷ 2a²</strong>.',
                '<p><strong>4a³</strong></p><p>8 ÷ 2 = 4 and a⁵ ÷ a² = a³.</p>'
            ],
            59 => [
                'Evaluate <strong>10³ − 9²</strong>.',
                '<p><strong>919</strong></p><p>10³ = 1000 and 9² = 81.</p><p>1000 − 81 = <strong>919</strong>.</p>'
            ],
            60 => [
                'Which is greater: <strong>2⁶</strong> or <strong>4³</strong>?',
                '<p><strong>They are equal.</strong></p><p>2⁶ = 64 and 4³ = 64.</p>'
            ],

            /*
            |--------------------------------------------------------------------------
            | Skill 4 — Decimals (20 cards)
            |--------------------------------------------------------------------------
            */
            61 => [
                'Evaluate <strong>2.5 + 3.75</strong>.',
                '<p><strong>6.25</strong></p><p>Align the decimal points:</p><p>2.50 + 3.75 = <strong>6.25</strong>.</p>'
            ],
            62 => [
                'Evaluate <strong>8.4 − 2.75</strong>.',
                '<p><strong>5.65</strong></p><p>8.40 − 2.75 = <strong>5.65</strong>.</p>'
            ],
            63 => [
                'Evaluate <strong>3.2 × 4</strong>.',
                '<p><strong>12.8</strong></p>'
            ],
            64 => [
                'Evaluate <strong>7.5 ÷ 3</strong>.',
                '<p><strong>2.5</strong></p>'
            ],
            65 => [
                'Evaluate <strong>1.25 + 0.75</strong>.',
                '<p><strong>2</strong></p>'
            ],
            66 => [
                'Evaluate <strong>5.6 × 0.5</strong>.',
                '<p><strong>2.8</strong></p><p>Multiplying by 0.5 is equivalent to taking half.</p>'
            ],
            67 => [
                'Evaluate <strong>12.6 ÷ 0.3</strong>.',
                '<p><strong>42</strong></p><p>12.6 ÷ 0.3 = 126 ÷ 3 = <strong>42</strong>.</p>'
            ],
            68 => [
                'Evaluate <strong>4.25 + 2.8 − 1.05</strong>.',
                '<p><strong>6</strong></p><p>4.25 + 2.80 = 7.05.</p><p>7.05 − 1.05 = <strong>6</strong>.</p>'
            ],
            69 => [
                'Evaluate <strong>0.4²</strong>.',
                '<p><strong>0.16</strong></p><p>0.4 × 0.4 = <strong>0.16</strong>.</p>'
            ],
            70 => [
                'Evaluate <strong>2.5²</strong>.',
                '<p><strong>6.25</strong></p><p>2.5 × 2.5 = <strong>6.25</strong>.</p>'
            ],
            71 => [
                'Evaluate <strong>10.5 + 2.35</strong>.',
                '<p><strong>12.85</strong></p>'
            ],
            72 => [
                'Evaluate <strong>15.2 − 8.65</strong>.',
                '<p><strong>6.55</strong></p>'
            ],
            73 => [
                'Evaluate <strong>1.2 × 2.5</strong>.',
                '<p><strong>3</strong></p><p>12 × 25 = 300, then account for three decimal places → 3.00.</p>'
            ],
            74 => [
                'Evaluate <strong>9.6 ÷ 0.8</strong>.',
                '<p><strong>12</strong></p><p>96 ÷ 8 = <strong>12</strong>.</p>'
            ],
            75 => [
                'Evaluate <strong>3.5 + 4.25 × 2</strong>.',
                '<p><strong>12</strong></p><p>Multiply first: 4.25 × 2 = 8.5.</p><p>3.5 + 8.5 = <strong>12</strong>.</p>'
            ],
            76 => [
                'Evaluate <strong>(2.5 + 1.5)²</strong>.',
                '<p><strong>16</strong></p><p>2.5 + 1.5 = 4.</p><p>4² = <strong>16</strong>.</p>'
            ],
            77 => [
                'Evaluate <strong>20 − 3.5 × 4</strong>.',
                '<p><strong>6</strong></p><p>3.5 × 4 = 14.</p><p>20 − 14 = <strong>6</strong>.</p>'
            ],
            78 => [
                'Evaluate <strong>6.4 + 2.4 ÷ 0.6</strong>.',
                '<p><strong>10.4</strong></p><p>2.4 ÷ 0.6 = 4.</p><p>6.4 + 4 = <strong>10.4</strong>.</p>'
            ],
            79 => [
                'Evaluate <strong>0.25 × 0.4</strong>.',
                '<p><strong>0.1</strong></p>'
            ],
            80 => [
                'Evaluate <strong>5.5² − 4.5²</strong>.',
                '<p><strong>10</strong></p><p>5.5² = 30.25.</p><p>4.5² = 20.25.</p><p>30.25 − 20.25 = <strong>10</strong>.</p>'
            ],

            /*
            |--------------------------------------------------------------------------
            | Skill 5 — Fractions (20 cards)
            |--------------------------------------------------------------------------
            */
            81 => [
                'Evaluate <strong>1/2 + 1/4</strong>.',
                '<p><strong>3/4</strong></p><p>Convert 1/2 to 2/4:</p><p>2/4 + 1/4 = <strong>3/4</strong>.</p>'
            ],
            82 => [
                'Evaluate <strong>3/4 − 1/2</strong>.',
                '<p><strong>1/4</strong></p><p>3/4 − 2/4 = <strong>1/4</strong>.</p>'
            ],
            83 => [
                'Evaluate <strong>2/3 × 3/4</strong>.',
                '<p><strong>1/2</strong></p><p>(2 × 3)/(3 × 4) = 6/12 = <strong>1/2</strong>.</p>'
            ],
            84 => [
                'Evaluate <strong>3/5 ÷ 2/5</strong>.',
                '<p><strong>3/2</strong></p><p>Keep, change, flip:</p><p>3/5 × 5/2 = 15/10 = <strong>3/2</strong>.</p>'
            ],
            85 => [
                'Evaluate <strong>1/3 + 1/6</strong>.',
                '<p><strong>1/2</strong></p><p>1/3 = 2/6.</p><p>2/6 + 1/6 = 3/6 = <strong>1/2</strong>.</p>'
            ],
            86 => [
                'Evaluate <strong>5/6 − 1/3</strong>.',
                '<p><strong>1/2</strong></p><p>1/3 = 2/6.</p><p>5/6 − 2/6 = 3/6 = <strong>1/2</strong>.</p>'
            ],
            87 => [
                'Evaluate <strong>2/5 + 3/10</strong>.',
                '<p><strong>7/10</strong></p><p>2/5 = 4/10.</p><p>4/10 + 3/10 = <strong>7/10</strong>.</p>'
            ],
            88 => [
                'Evaluate <strong>7/8 − 1/4</strong>.',
                '<p><strong>5/8</strong></p><p>1/4 = 2/8.</p><p>7/8 − 2/8 = <strong>5/8</strong>.</p>'
            ],
            89 => [
                'Evaluate <strong>3/4 × 2/3</strong>.',
                '<p><strong>1/2</strong></p><p>6/12 simplifies to <strong>1/2</strong>.</p>'
            ],
            90 => [
                'Evaluate <strong>5/6 ÷ 5/12</strong>.',
                '<p><strong>2</strong></p><p>5/6 × 12/5 = 60/30 = <strong>2</strong>.</p>'
            ],
            91 => [
                'Evaluate <strong>1/2 + 2/3</strong>.',
                '<p><strong>7/6 = 1 1/6</strong></p><p>The LCD is 6.</p><p>3/6 + 4/6 = 7/6.</p>'
            ],
            92 => [
                'Evaluate <strong>5/8 + 1/4</strong>.',
                '<p><strong>7/8</strong></p><p>1/4 = 2/8.</p><p>5/8 + 2/8 = <strong>7/8</strong>.</p>'
            ],
            93 => [
                'Evaluate <strong>2 − 3/4</strong>.',
                '<p><strong>5/4 = 1 1/4</strong></p><p>2 = 8/4.</p><p>8/4 − 3/4 = 5/4.</p>'
            ],
            94 => [
                'Evaluate <strong>3 + 1/2</strong>.',
                '<p><strong>7/2 = 3 1/2</strong></p>'
            ],
            95 => [
                'Evaluate <strong>(1/2)²</strong>.',
                '<p><strong>1/4</strong></p><p>(1/2)² = 1/2 × 1/2 = <strong>1/4</strong>.</p>'
            ],
            96 => [
                'Evaluate <strong>(3/4)²</strong>.',
                '<p><strong>9/16</strong></p><p>3²/4² = <strong>9/16</strong>.</p>'
            ],
            97 => [
                'Evaluate <strong>1 − 2/5</strong>.',
                '<p><strong>3/5</strong></p><p>1 = 5/5.</p><p>5/5 − 2/5 = <strong>3/5</strong>.</p>'
            ],
            98 => [
                'Evaluate <strong>2/3 + 5/6</strong>.',
                '<p><strong>3/2 = 1 1/2</strong></p><p>2/3 = 4/6.</p><p>4/6 + 5/6 = 9/6 = <strong>3/2</strong>.</p>'
            ],
            99 => [
                'Evaluate <strong>4/5 × 10/3</strong>.',
                '<p><strong>8/3 = 2 2/3</strong></p><p>40/15 simplifies to 8/3.</p>'
            ],
            100 => [
                'Evaluate <strong>7/9 ÷ 14/27</strong>.',
                '<p><strong>3/2 = 1 1/2</strong></p><p>7/9 × 27/14 = 189/126 = <strong>3/2</strong>.</p>'
            ],

            /*
            |--------------------------------------------------------------------------
            | Skill 6 — Algebraic Representation (20 cards)
            |--------------------------------------------------------------------------
            */
            101 => [
                '<p><strong>Number Expressions:</strong></p><ul><li><p>2 x 2 - 3 x 1</p></li><li><p>3 x 3 - 4 x 2</p></li><li><p>4 x 4 - 5 x 3</p></li><li><p>5 x 5 - 6 x 4</p></li></ul><p>Which of the following algebraic expressions represents the set of number expressions above?</p><p>a. (n)(n) − (n + 3)(n + 1)<br>b. (n)(n) − [(n + 1)(n − 1)]<br>c. (n − 1)(n − 1) − n(n − 2)<br>d. n<sup>2</sup> − 3n(1)<br>e. n<sup>2</sup> − n − 1</p>',
                '<p>b. (n)(n) − [(n + 1)(n − 1)] and c. (n − 1)(n − 1) − n(n − 2)</p><p>Since the numerical expressions simplify to 1, the correct algebraic expression should also simplify to 1.</p><p>b. (n)(n) − [(n + 1)(n − 1)]<br>= n<sup>2</sup> - (n<sup>2</sup> - 1)<br>= n<sup>2</sup> - n<sup>2</sup> + 1<br>= 1</p><p>c. (n − 1)(n − 1) − n(n − 2)<br>= n<sup>2</sup> - 2n + 1 - (n<sup>2</sup> - 2n)<br>= n<sup>2</sup> - 2n + 1 - n<sup>2</sup> + 2n<br>= n<sup>2</sup> - n<sup>2</sup> + 2n - 2n + 1<br>= 1</p>'
            ],
            102 => [
                'Translate the phrase <strong>“5 more than a number”</strong> into an algebraic expression.',
                '<p><strong>n + 5</strong></p><p>Let n represent the unknown number. “5 more than” means add 5.</p>'
            ],
            103 => [
                'Translate <strong>“7 less than a number”</strong> into an algebraic expression.',
                '<p><strong>n − 7</strong></p><p>“Less than” indicates subtraction from the number.</p>'
            ],
            104 => [
                'Translate <strong>“three times a number”</strong> into an algebraic expression.',
                '<p><strong>3n</strong></p><p>Multiplication by 3 is represented by 3n.</p>'
            ],
            105 => [
                'Translate <strong>“twice a number increased by 4”</strong> into an algebraic expression.',
                '<p><strong>2n + 4</strong></p>'
            ],
            106 => [
                'Translate <strong>“the sum of a number and 9”</strong> into an algebraic expression.',
                '<p><strong>n + 9</strong></p>'
            ],
            107 => [
                'Translate <strong>“the difference between a number and 6”</strong> into an algebraic expression.',
                '<p><strong>n − 6</strong></p>'
            ],
            108 => [
                'Translate <strong>“the product of 4 and a number”</strong> into an algebraic expression.',
                '<p><strong>4n</strong></p>'
            ],
            109 => [
                'Translate <strong>“a number divided by 5”</strong> into an algebraic expression.',
                '<p><strong>n/5</strong></p>'
            ],
            110 => [
                'Translate <strong>“8 divided by a number”</strong> into an algebraic expression.',
                '<p><strong>8/n</strong></p><p>The order matters: “8 divided by a number” means 8 ÷ n.</p>'
            ],
            111 => [
                'Write an algebraic expression for <strong>“the square of a number plus 3.”</strong>',
                '<p><strong>n² + 3</strong></p>'
            ],
            112 => [
                'Write an algebraic expression for <strong>“5 times the square of a number.”</strong>',
                '<p><strong>5n²</strong></p>'
            ],
            113 => [
                'Write an algebraic expression for <strong>“the square of the sum of a number and 2.”</strong>',
                '<p><strong>(n + 2)²</strong></p><p>The parentheses are important because the entire sum is squared.</p>'
            ],
            114 => [
                'Write an algebraic expression for <strong>“the sum of the squares of a number and 4.”</strong>',
                '<p><strong>n² + 4²</strong>, which simplifies to <strong>n² + 16</strong>.</p>'
            ],
            115 => [
                'If a number is represented by <strong>n</strong>, represent the next consecutive number.',
                '<p><strong>n + 1</strong></p>'
            ],
            116 => [
                'If a number is represented by <strong>n</strong>, represent the previous consecutive number.',
                '<p><strong>n − 1</strong></p>'
            ],
            117 => [
                'Represent the sum of <strong>three consecutive integers</strong> if the first integer is n.',
                '<p><strong>n + (n + 1) + (n + 2)</strong></p><p>This can be simplified to <strong>3n + 3</strong>.</p>'
            ],
            118 => [
                'Represent the product of <strong>two consecutive integers</strong> if the first integer is n.',
                '<p><strong>n(n + 1)</strong></p>'
            ],
            119 => [
                'A number is increased by 5 and then multiplied by 3. Write the algebraic expression.',
                '<p><strong>3(n + 5)</strong></p><p>The parentheses show that the number is increased by 5 before multiplying by 3.</p>'
            ],
            120 => [
                'A number is multiplied by 4 and then decreased by 7. Write the algebraic expression.',
                '<p><strong>4n − 7</strong></p>'
            ],
        ];

        $learningMaterials = [];

        foreach ($cards as $id => [$front, $back]) {
            // Skills are grouped into 20 cards each:
            // 1–20   => Skill 1
            // 21–40  => Skill 2
            // 41–60  => Skill 3
            // 61–80  => Skill 4
            // 81–100 => Skill 5
            // 101–120 => Skill 6
            $skillId = (int) ceil($id / 20);

            $learningMaterials[] = [
                'id' => $id,
                'grade_lvl_id' => 2,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => $skillId,
                'title' => match ($skillId) {
                    1 => 'Evaluating Number Expressions Using GEMDAS',
                    2 => 'Finding Algebraic Expressions From Number Patterns',
                    3 => 'Working With Exponents in Number Expressions',
                    4 => 'Evaluating Number Expressions With Decimals',
                    5 => 'Evaluating Number Expressions With Fractions',
                    6 => 'Representing Number Expressions Algebraically',
                },
                'material_type' => 'flash_card',
                'content' => null,
                'content_front' => json_encode("<p>{$front}</p>"),
                'content_back' => json_encode($back),
                'content_audio_visual_path' => null,
                'attachments' => json_encode([]),
                'attachment_file_names' => json_encode([]),
                'created_at' => '2026-09-14 13:10:44',
                'updated_at' => '2026-09-14 13:24:38',
            ];
        }

        DB::table('learning_materials')->insert($learningMaterials);
    }
}