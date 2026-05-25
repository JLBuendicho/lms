<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentController;

Route::controller(AssessmentController::class)->group(function () {
    Route::get('/assessment/{subjectName}/{assessmentType}/start', 'startAssessment')->name('assessment.start');
    Route::get('/assessment/{subjectName}/{assessmentType}/question/{step}', 'showQuestion')->name('assessment.question.show');
    Route::post('/assessment/{subjectName}/{assessmentType}/question/{step}', 'storeQuestionResponse')->name('assessment.question.store');
    Route::get('/assessment/{subjectName}/{assessmentType}/results', 'assessmentResults')->name('assessment.results');
});