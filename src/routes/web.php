<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('/test', function () {
    $topicIds =  \App\Models\Topics::where('domain_id', 1)->pluck('id')->toArray();

    return response()->json($topicIds);
})->name('test');

Route::get('/student-view-test/{id}', [StudentController::class, 'show'])->name('test');

require __DIR__.'/bkt.php';
require __DIR__.'/question-responses.php';
require __DIR__.'/settings.php';
require __DIR__.'/students.php';