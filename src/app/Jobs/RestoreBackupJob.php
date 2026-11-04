<?php

namespace App\Jobs;

use App\Console\Commands\RestoreBackup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RestoreBackupJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $backup
    ) {}

    public function handle(): void
    {
        Log::info('Starting backup restoration', [
            'backup' => $this->backup,
            'basename' => basename($this->backup),
            'storage_path' => Storage::disk('local')->path(
                'CalauanLMS/' . basename($this->backup)
            ),
            'exists' => Storage::disk('local')->exists(
                'CalauanLMS/' . basename($this->backup)
            ),
        ]);

        $exitCode = Artisan::call(
            'backup:restore',
            [
                'backup' => $this->backup,
                '--force' => true,
            ]
        );

        Log::info('Backup restoration command finished', [
            'exit_code' => $exitCode,
            'output' => Artisan::output(),
        ]);

        if ($exitCode !== 0) {
            throw new \RuntimeException(
                Artisan::output()
            );
        }
    }
}
