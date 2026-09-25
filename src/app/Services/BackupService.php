<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\BackupDestination\BackupDestination;

class BackupService
{
    public function createBackup(): int
    {
        return Artisan::call('backup:run');
    }

    public function listBackups()
    {
        $disk = config('backup.destination.disks')[0];

        $destination = BackupDestination::create(
            $disk,
            config('backup.backup.name')
        );

        return $destination->backups();
    }
}