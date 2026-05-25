<?php

namespace Database\Seeders;

use App\Models\Subjects;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructorCount = 5;
        User::factory()->instructor()->count($instructorCount)->create();

        $instructors = User::where('role', 'instructor')->get();

        $subject = Subjects::where('id', 1)->first();

        foreach ($instructors as $instructor) {
            $instructor->subjects()->attach($subject);
        }
    }
}
