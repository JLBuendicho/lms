<?php

use App\Http\Controllers\BktTrainingLogController;
use Illuminate\Support\Facades\Route;

Route::controller(BktTrainingLogController::class)->group(function () {
    Route::post('/bkt-training-callback','bktTrainingCallback')->name('bkt-training-callback');
});