<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'verified'])->get('/get-dashboard', function () {
    return match (auth()->user()->role) {
        'student' => redirect()->route('dashboard'),
        'root' => redirect('/admin/root'),
        'instructor' => redirect('/admin/instructor'),
        default => abort(403),
    };
})->name('get-dashboard');

// Route::middleware(['auth', 'verified', 'role:root'])->group(function () {
//     Route::view('/admin/root/', 'filament.admin.pages.root-dashboard')->name('admin.root.dashboard');
// });

// Route::middleware(['auth', 'verified', 'role:instructor'])->group(function () {
//     Route::view('/admin/instructor/', 'filament.admin.pages.instructor-dashboard')->name('admin.instructor.dashboard');
// });

require __DIR__.'/bkt.php';
require __DIR__.'/learning-materials.php';
require __DIR__.'/questions.php';
require __DIR__.'/question-responses.php';
require __DIR__.'/settings.php';
require __DIR__.'/students.php';
require __DIR__.'/subjects.php';
require __DIR__.'/assessment.php';
require __DIR__.'/backups.php';