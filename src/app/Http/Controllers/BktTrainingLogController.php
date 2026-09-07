<?php

namespace App\Http\Controllers;

use App\Models\BktTrainingLog;
use Illuminate\Http\Request;

class BktTrainingLogController extends Controller
{
    public function bktTrainingCallback(Request $request) {
        $request->validate([
            "runId" => "required|integer",
            "status" => "required|string",
            "error" => "nullable|string",
        ]);

        BktTrainingLog::where("id", $request->input("runId"))->update([
            "status" => $request->input("status"),
            "error" => $request->input("error"),
            "finished_at" => now(),
        ]);

         return response()->json([
             "status" => 200,
             "message" => "Callback received",
         ]);
    }
}
