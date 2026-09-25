<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/admin/backups/{backup}/download', function (string $backup) {

    abort_unless(
        auth()->check(),
        403
    );

    $path = 'CalauanLMS/' . basename($backup);

    abort_unless(
        Storage::disk('local')->exists($path),
        404
    );

    return Storage::disk('local')->download($path);

})->name('admin.backups.download');