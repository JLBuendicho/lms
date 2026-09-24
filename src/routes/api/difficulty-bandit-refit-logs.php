<?php

use App\Http\Controllers\DifficultyBanditRefitLogController;
use Illuminate\Support\Facades\Route;

Route::controller(DifficultyBanditRefitLogController::class)->group(function () {
    Route::post('/difficulty-bandit-refit-callback', 'difficultyBanditRefitCallback')->name('difficulty-bandit-refit-callback');
});