<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Create a backup of the PostgreSQL database';

    public function handle()
    {
        $dbName = config('database.connections.pgsql.database');
        $dbUser = config('database.connections.pgsql.username');
        $dbPassword = config('database.connections.pgsql.password');
        $dbHost = config('database.connections.pgsql.host');
        $dbPort = config('database.connections.pgsql.port');

        $backupPath = storage_path('app/private/Laravel');
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $backupFileName = $dbName . '_' . date('Y-m-d_H-i-s') . '.dump';
        $backupFilePath = $backupPath . '/' . $backupFileName;

        $command = [
            'pg_dump',
            '-U',
            $dbUser,
            '-h',
            $dbHost,
            '-p',
            $dbPort,
            '-F',
            'c',
            '-b',
            '-v',
            '-f',
            $backupFilePath,
            $dbName,
        ];

        putenv("PGPASSWORD=$dbPassword");

        $process = new Process($command);
        $process->run();
        
        if (!$process->isSuccessful()) {
            $this->error('Backup failed: ' . $process->getErrorOutput());
            return;
        }

        if (file_exists($backupFilePath)) {
            $this->info('Backup created successfully: ' . $backupFilePath);
        } else {
            $this->error('Backup file was not created: ' . $backupFilePath);
        }
    }
}
