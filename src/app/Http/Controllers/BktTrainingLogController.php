<?php

namespace App\Http\Controllers;

use App\Models\BktTrainingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BktTrainingLogController extends Controller
{
    public function bktTrainingCallback(Request $request) {
        $request->validate([
            "runId" => "required|integer",
            "status" => "required|string",
            "error" => "nullable|string",
        ]);

        $updated = BktTrainingLog::where("id", $request->input("runId"))->update([
            "status" => $request->input("status"),
            "error" => $request->input("error"),
            "finished_at" => now(),
        ]);

        Log::info("bkt training callback", ["payload" => $request->all(), "rows_updated" => $updated]);

        if ($updated === 0) {
            return response()->json(["message" => "Run not found"], 404);
        }

         return response()->json([
             "status" => 200,
             "message" => "Callback received",
         ]);
    }
}
