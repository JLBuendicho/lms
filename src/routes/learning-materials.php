<?php

use App\Http\Controllers\LearningMaterialController;
use Illuminate\Support\Facades\Route;

Route::controller(LearningMaterialController::class)->group( function () {
    Route::get('/learning-materials/{skillId}/flash-cards', 'getFlashCard')->name('learning-materials.flash-card');
    Route::get('/learning-materials/{skillId}/lessons', 'getLessons')->name('skill.learning-materials');
    Route::get('/learning-materials/{skillId}/lessons/{lessonId}', 'showLesson')->name('learning-materials.resource');
});