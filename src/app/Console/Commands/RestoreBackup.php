<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use ZipArchive;

class RestoreBackup extends Command
{
    protected $signature = 'backup:restore
                            {backup : Backup filename}
                            {--force : Skip confirmation}';

    protected $description = 'Restore the LMS database from a backup';

    public function handle(): int
    {
        $backup = $this->argument('backup');

        $disk = Storage::disk('local');

        $path = 'CalauanLMS/' . basename($backup);

        if (! $disk->exists($path)) {
            $this->error("Backup does not exist: {$backup}");

            return self::FAILURE;
        }

        if (! $this->option('force')) {
            if (! $this->confirm(
                "Restore {$backup}? This will replace the current database."
            )) {
                $this->info('Restore cancelled.');

                return self::SUCCESS;
            }
        }

        $zipPath = $disk->path($path);

        $restoreDirectory = storage_path(
            'app/private/restore-tmp/' . uniqid()
        );

        mkdir($restoreDirectory, 0755, true);

        try {
            $this->info('Extracting backup...');

            $zip = new ZipArchive();

            if ($zip->open($zipPath) !== true) {
                throw new \RuntimeException(
                    'Unable to open backup ZIP.'
                );
            }

            if (! $zip->extractTo($restoreDirectory)) {
                throw new \RuntimeException(
                    'Unable to extract backup.'
                );
            }

            $zip->close();

            $this->info('Backup extracted.');

            $sqlFiles = glob(
                $restoreDirectory . '/db-dumps/*.sql'
            );

            if (empty($sqlFiles)) {
                throw new \RuntimeException(
                    'No SQL dump was found in the backup.'
                );
            }

            $sqlFile = $sqlFiles[0];

            $this->info(
                'SQL dump found: ' . basename($sqlFile)
            );

            Artisan::call('down', [
                '--render' => 'errors::503',
            ]);

            try {
                $this->restoreDatabase($sqlFile);

                Artisan::call('optimize:clear');

                $this->info('Database restored successfully.');
            } finally {
                Artisan::call('up');
            }

            return self::SUCCESS;

        } catch (\Throwable $e) {

            $this->error(
                'Restore failed: ' . $e->getMessage()
            );

            try {
                Artisan::call('up');
            } catch (\Throwable) {
                // Don't hide the original error.
            }

            return self::FAILURE;

        } finally {
            $this->deleteDirectory($restoreDirectory);
        }
    }

    protected function restoreDatabase(string $sqlFile): void
    {
        $connection = config('database.default');

        $config = config("database.connections.{$connection}");

        if (($config['driver'] ?? null) !== 'mysql') {
            throw new \RuntimeException(
                'Restore currently supports MySQL only.'
            );
        }

        $process = new Process([
            'mysql',
            '--host=' . $config['host'],
            '--port=' . $config['port'],
            '--user=' . $config['username'],
            $config['database'],
        ]);

        $process->setEnv([
            'MYSQL_PWD' => $config['password'],
        ]);

        $process->setInput(
            file_get_contents($sqlFile)
        );

        $process->setTimeout(null);

        $process->run();

        if (! $process->isSuccessful()) {
            throw new \RuntimeException(
                $process->getErrorOutput()
            );
        }
    }

    protected function deleteDirectory(string $directory): void
    {
        if (! is_dir($directory)) {
            return;
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $directory,
                \FilesystemIterator::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }

        rmdir($directory);
    }
}