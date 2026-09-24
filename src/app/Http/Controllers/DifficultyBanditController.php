<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessDifficultyBanditRefit;
use App\Models\DifficultyBanditInteractions;
use App\Models\DifficultyBanditRefitLog;
use Illuminate\Http\Request;

class DifficultyBanditController extends Controller
{
    public function refitDifficultyBandit() {
        $runId = DifficultyBanditRefitLog::create([
            "status" => "running",
            "interaction_count" => DifficultyBanditInteractions::count(),
            "started_at" => now(),
        ])->id;

        ProcessDifficultyBanditRefit::dispatch($runId);

        return response()->json([
            "status" => 200,
            "run_id" => $runId,
            "message" => "Difficulty Bandit Refit started",
        ]);
    }
}
