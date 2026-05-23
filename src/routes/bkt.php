<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BktController;

Route::controller(BktController::class)->group(function () {
    Route::get('/train-bkt', 'trainBkt')->name('train-bkt');
    Route::get('/mastery-records','indexMasteryRecords')->name('mastery-records.index');
    Route::get('/init-masteries','initMasteries')->name('init-masteries');
    Route::get('/update-mastery-records','updateMasteryRecords')->name('update-mastery-records');
    Route::get('/get-student-topic-skill-attempt-count/{userId}/{topicId}', 'getStudentTopicSkillAttemptCount')->name('get-student-topic-skill-attempt-count');
    Route::get('/get-student-topic-mastery/{userId}/{topicId}', 'getStudentTopicMastery')->name('get-student-topic-mastery');
    Route::get('/get-student-domain-skill-attempt-count/{userId}/{domainId}', 'getStudentDomainSkillAttemptCount')->name('get-student-domain-skill-attempt-count');
    Route::get('/get-student-domain-mastery/{userId}/{domainId}', 'getStudentDomainMastery')->name('get-student-domain-mastery');
    Route::get('/get-student-subject-skill-attempt-count/{userId}/{subjectId}', 'getStudentSubjectSkillAttemptCount')->name('get-student-subject-skill-attempt-count');
    Route::get('/get-student-subject-mastery/{userId}/{subjectId}', 'getStudentSubjectMastery')->name('get-student-subject-mastery');
});