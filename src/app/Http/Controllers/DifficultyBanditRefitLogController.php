<?php

namespace App\Http\Controllers;

use App\Models\DifficultyBanditRefitLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DifficultyBanditRefitLogController extends Controller
{
    public function difficultyBanditRefitCallback(Request $request)
    {
        $request->validate([
            "runId" => "required|integer",
            "status" => "required|string",
            "error" => "nullable|string",
        ]);

        // DifficultyBanditRefitLog::where("id", $request->input("runId"))->update([
        //     "status" => $request->input("status"),
        //     "error" => $request->input("error"),
        //     "finished_at" => now(),
        // ]);

        $updated = DifficultyBanditRefitLog::where("id", $request->input("runId"))->update([
            "status" => $request->input("status"),
            "error" => $request->input("error"),
            "finished_at" => now(),
        ]);

        Log::info("difficulty bandit refit callback", ["payload" => $request->all(), "rows_updated" => $updated]);

        if ($updated === 0) {
            return response()->json(["message" => "Run not found"], 404);
        }

        return response()->json([
            "status" => 200,
            "message" => "Callback received",
        ]);
    }
}
