<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup {--full : Perform a full backup} {--incremental : Perform an incremental backup} {--differential : Perform a differential backup}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a backup of the PostgreSQL database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Получаем параметры подключения к базе данных
        $dbName = config('database.connections.pgsql.database');
        $dbUser = config('database.connections.pgsql.username');
        $dbPassword = config('database.connections.pgsql.password');
        $dbHost = config('database.connections.pgsql.host');
        $dbPort = config('database.connections.pgsql.port');

        // Указываем путь для сохранения резервной копии
        $backupPath = storage_path('app/backups/');
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        // Формируем имя файла резервной копии
        $backupType = $this->option('full') ? 'full' : ($this->option('incremental') ? 'incremental' : 'differential');
        $backupFileName = $dbName . '_' . $backupType . '_' . date('Y-m-d_H-i-s') . '.sql';
        $backupFilePath = $backupPath . $backupFileName;

        // Команда pg_dump для создания резервной копии
        $command = sprintf(
            'PGPASSWORD=%s pg_dump -U %s -h %s -p %s -F c -b -v -f %s %s',
            escapeshellarg($dbPassword),
            escapeshellarg($dbUser),
            escapeshellarg($dbHost),
            escapeshellarg($dbPort),
            escapeshellarg($backupFilePath),
            escapeshellarg($dbName)
        );

        // Выполняем команду
        exec($command);

        // Проверяем, успешно ли создана резервная копия
        if (file_exists($backupFilePath)) {
            $this->info('Backup created successfully: ' . $backupFilePath);

            // Загружаем резервную копию в облачное хранилище (например, Amazon S3)
            Storage::disk('s3')->putFileAs('backups', new \Illuminate\Http\File($backupFilePath), $backupFileName);
        } else {
            $this->error('Backup failed!');
        }
    }
}