<?php

namespace App\Jobs;

use App\Console\Commands\RestoreBackup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

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
        $exitCode = Artisan::call(
            'backup:restore',
            [
                'backup' => $this->backup,
                '--force' => true,
            ]
        );

        if ($exitCode !== 0) {
            throw new \RuntimeException(
                Artisan::output()
            );
        }
    }
}