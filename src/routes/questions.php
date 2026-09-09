<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::controller(QuestionController::class)->group( function () {
    Route::get("questions/practice/{skillId}", "getPracticeQuestion")->name("questions.practice");
});