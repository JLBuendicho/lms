<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use ZipArchive;
use RuntimeException;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use FilesystemIterator;

class RestoreBackup extends Command
{
    protected $signature = 'backup:restore
                            {backup : Backup filename}
                            {--force : Skip confirmation}';

    protected $description = 'Restore the LMS database and uploaded assets from a backup';

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
                "Restore {$backup}? This will replace the current database and overwrite matching uploaded assets."
            )) {
                $this->info('Restore cancelled.');

                return self::SUCCESS;
            }
        }

        $zipPath = $disk->path($path);

        $restoreDirectory = storage_path(
            'app/private/restore-tmp/' . uniqid('', true)
        );

        if (! mkdir($restoreDirectory, 0755, true) && ! is_dir($restoreDirectory)) {
            $this->error('Unable to create temporary restore directory.');

            return self::FAILURE;
        }

        $maintenanceMode = false;

        try {
            $this->info('Opening backup archive...');

            $zip = new ZipArchive();

            if ($zip->open($zipPath) !== true) {
                throw new RuntimeException(
                    'Unable to open backup ZIP.'
                );
            }

            // Validate archive paths before extraction.
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $entry = $zip->getNameIndex($i);

                $normalized = str_replace('\\', '/', $entry);

                if (
                    str_starts_with($normalized, '/') ||
                    preg_match('/^[a-zA-Z]:/', $normalized) ||
                    in_array('..', explode('/', $normalized), true)
                ) {
                    $zip->close();

                    throw new RuntimeException(
                        "Unsafe archive entry: {$entry}"
                    );
                }
            }

            $this->info('Extracting backup...');

            if (! $zip->extractTo($restoreDirectory)) {
                $zip->close();

                throw new RuntimeException(
                    'Unable to extract backup.'
                );
            }

            $zip->close();

            $this->info('Backup extracted.');

            // Locate SQL dump.
            $sqlFiles = glob(
                $restoreDirectory . '/db-dumps/*.sql'
            );

            if (empty($sqlFiles)) {
                throw new RuntimeException(
                    'No SQL dump was found in the backup.'
                );
            }

            $sqlFile = $sqlFiles[0];

            $this->info(
                'SQL dump found: ' . basename($sqlFile)
            );

            // Validate asset directory before replacing database.
            $assetDirectory = $this->findPublicStorageDirectory(
                $restoreDirectory
            );

            $this->info(
                'Public storage directory found: ' . $assetDirectory
            );

            // Enter maintenance mode.
            Artisan::call('down', [
                '--render' => 'errors::503',
            ]);

            $maintenanceMode = true;

            try {
                // Restore database.
                $this->restoreDatabase($sqlFile);

                $this->info('Database restored successfully.');

                // Restore uploaded assets.
                $this->restorePublicAssets($assetDirectory);

                // Ensure public storage symlink exists.
                Artisan::call('storage:link', [
                    '--force' => true,
                ]);

                // Clear application caches.
                Artisan::call('optimize:clear');

                $this->info(
                    'LMS database and assets restored successfully.'
                );

                Log::info('LMS backup restoration completed.', [
                    'backup' => $backup,
                    'sql_file' => basename($sqlFile),
                    'asset_directory' => $assetDirectory,
                ]);

            } finally {
                Artisan::call('up');

                $maintenanceMode = false;
            }

            return self::SUCCESS;

        } catch (\Throwable $e) {
            Log::error('LMS backup restoration failed.', [
                'backup' => $backup,
                'exception' => $e,
            ]);

            $this->error(
                'Restore failed: ' . $e->getMessage()
            );

            return self::FAILURE;

        } finally {
            if ($maintenanceMode) {
                try {
                    Artisan::call('up');
                } catch (\Throwable $e) {
                    Log::error(
                        'Unable to disable maintenance mode.',
                        ['exception' => $e]
                    );
                }
            }

            $this->deleteDirectory($restoreDirectory);
        }
    }

    /**
     * Find storage/app/public inside the extracted backup.
     */
    protected function findPublicStorageDirectory(
        string $restoreDirectory
    ): string {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $restoreDirectory,
                FilesystemIterator::SKIP_DOTS
            ),
            RecursiveIteratorIterator::SELF_FIRST
        );

        $matches = [];

        foreach ($iterator as $item) {
            if (! $item->isDir() || $item->isLink()) {
                continue;
            }

            $path = str_replace(
                '\\',
                '/',
                $item->getPathname()
            );

            if (preg_match('~(?:^|/)storage/app/public$~', $path)) {
                $matches[] = $item->getPathname();
            }
        }

        if (count($matches) !== 1) {
            throw new RuntimeException(
                count($matches) === 0
                    ? 'Public storage assets were not found in the backup.'
                    : 'Multiple public storage directories were found in the backup.'
            );
        }

        return $matches[0];
    }

    /**
     * Restore uploaded assets into storage/app/public.
     */
    protected function restorePublicAssets(
        string $source
    ): void {
        $destination = storage_path('app/public');

        if (
            ! is_dir($destination) &&
            ! mkdir($destination, 0755, true) &&
            ! is_dir($destination)
        ) {
            throw new RuntimeException(
                'Unable to create public storage directory.'
            );
        }

        $this->info('Restoring uploaded assets...');

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $source,
                FilesystemIterator::SKIP_DOTS
            ),
            RecursiveIteratorIterator::SELF_FIRST
        );

        $restoredFiles = 0;

        foreach ($iterator as $file) {
            $relativePath = substr(
                $file->getPathname(),
                strlen($source) + 1
            );

            $target = $destination . DIRECTORY_SEPARATOR . $relativePath;

            if ($file->isLink()) {
                throw new RuntimeException(
                    "Symbolic links are not supported: {$relativePath}"
                );
            }

            if ($file->isDir()) {
                if (
                    ! is_dir($target) &&
                    ! mkdir($target, 0755, true) &&
                    ! is_dir($target)
                ) {
                    throw new RuntimeException(
                        "Unable to create directory: {$relativePath}"
                    );
                }

                continue;
            }

            if (! copy($file->getPathname(), $target)) {
                throw new RuntimeException(
                    "Unable to restore asset: {$relativePath}"
                );
            }

            $restoredFiles++;
        }

        Log::info('Public assets restored.', [
            'source' => $source,
            'destination' => $destination,
            'restored_files' => $restoredFiles,
        ]);

        $this->info(
            "Restored {$restoredFiles} uploaded asset(s)."
        );
    }

    /**
     * Restore MySQL database.
     */
    protected function restoreDatabase(string $sqlFile): void
    {
        $connection = config('database.default');

        $config = config("database.connections.{$connection}");

        if (($config['driver'] ?? null) !== 'mysql') {
            throw new RuntimeException(
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
            throw new RuntimeException(
                $process->getErrorOutput()
            );
        }
    }

    /**
     * Delete temporary extraction directory.
     */
    protected function deleteDirectory(string $directory): void
    {
        if (! is_dir($directory)) {
            return;
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $directory,
                FilesystemIterator::SKIP_DOTS
            ),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $file) {
            if ($file->isLink()) {
                unlink($file->getPathname());
            } elseif ($file->isDir()) {
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }

        rmdir($directory);
    }
}