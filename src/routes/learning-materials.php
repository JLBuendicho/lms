<?php

use App\Http\Controllers\LearningMaterialController;
use Illuminate\Support\Facades\Route;

Route::controller(LearningMaterialController::class)->group( function () {
    Route::get('/learning-materials/{skillId}', 'getFlashCard')->name('learning-materials.flash-card');
});