<?php

use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::controller(SubjectController::class)->group(function () {
    Route::get('/subjects/{subjectId}', 'getStudentSubjectPage')->name('subject.page');
    Route::get('/subjects/{subjectId}/domains/{domainId}', 'getStudentSubjectDomainPage')->name('subject.domain.page');
    Route::get('/subjects/{subjectId}/topics/{topicId}','getStudentSubjectTopicPage')->name('subject.topic.page');
});