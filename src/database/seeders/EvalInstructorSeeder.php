<?php

namespace Database\Seeders;

use App\Models\Subjects;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvalInstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructor = User::create([
            'name' => 'Eval Instructor',
            'email' => 'instructor@example.com',
            'password' => bcrypt('password'),
            'role'=> 'instructor',
            'email_verified_at' => now(),
            'has_email_authentication' => true,
        ]);

        $subject = Subjects::where('id', 1)->first();
        
        $instructor->subjects()->attach($subject);
    }
}
