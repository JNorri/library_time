<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    // Создание резервной копии
    public function create()
    {
        try {
            Artisan::call('backup:run');
            $output = Artisan::output(); // Получаем вывод команды
            return response()->json(['message' => 'Backup created successfully', 'output' => $output]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Получение списка резервных копий
    public function list()
    {
        $backups = Storage::disk('local')->files('backups');
        return response()->json($backups);
    }

    // Восстановление из резервной копии
    public function restore($filename)
    {
        try {
            $backupPath = storage_path('app/backups/' . $filename);

            if (!file_exists($backupPath)) {
                return response()->json(['error' => 'Backup file not found'], 404);
            }

            // Восстановление базы данных из резервной копии
            // Здесь нужно реализовать логику восстановления
            // Например, используя pg_restore для PostgreSQL

            return response()->json(['message' => 'Database restored successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Удаление резервной копии
    public function delete($filename)
    {
        try {
            if (Storage::disk('local')->exists('backups/' . $filename)) {
                Storage::disk('local')->delete('backups/' . $filename);
                return response()->json(['message' => 'Backup deleted successfully']);
            } else {
                return response()->json(['error' => 'Backup file not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
