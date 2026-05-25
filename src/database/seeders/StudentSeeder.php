<?php

namespace Database\Seeders;

use App\Models\Subjects;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentCount = 100;
        User::factory()->student()->count($studentCount)->create();

        $students = User::where('role', 'student')->get();

        $subject = Subjects::where('id', 1)->first();

        foreach ($students as $student) {
            $student->subjects()->attach($subject);
        }
    }
}
