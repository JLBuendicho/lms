<?php

namespace Database\Seeders;

use App\Models\Subjects;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentEvaluatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [];

        for ($i = 1; $i <= 20; $i++) {
            $id = User::latest()->first()->id + 1;
            $lrn = str_pad($id, 12, "1", STR_PAD_LEFT);
            $students[] = User::create([
                'name' => 'Student Evaluator ' . $id,
                'email' => 'student' . $id . '@example.com',
                'lrn' => $lrn,
                'password' => bcrypt('password'),
                'role' => 'student',
                'email_verified_at' => now(),
                'has_email_authentication' => false,
            ]);
        }

        $subject = Subjects::where('id', 1)->first();

        foreach ($students as $student) {
            $student->subjects()->attach($subject);
        }
    }
}
