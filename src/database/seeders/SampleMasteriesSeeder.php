<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleMasteriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentIds = User::where('role', 'student')->orderBy('id', 'asc')->take(3)->pluck('id')->toArray();

        DB::table('mastery_records')->where('user_id', $studentIds[0])->update(['mastery' => 0.80]);
        DB::table('mastery_records')->where('user_id', $studentIds[1])->update(['mastery' => 0.65]);
        DB::table('mastery_records')->where('user_id', $studentIds[2])->update(['mastery' => 0.60]);
    }
}
