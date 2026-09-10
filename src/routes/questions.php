<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::controller(QuestionController::class)->group( function () {
    Route::post('questions/practice/', 'evaluatePracticeQuestionResponse')->name('questions.practice.evaluate');
    Route::get('questions/practice/{skillId}', 'getPracticeQuestion')->name('questions.practice');
    Route::get('result/questions/practice/', 'showPracticeQuestionResult')->name('questions.practice.result');
});