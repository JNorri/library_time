<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{

    /**
     * Список всех резервных копий.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Получаем список резервных копий из локального хранилища
        $backups = collect(Storage::disk('local')->files('backups'))
            ->map(function ($file) {
                return [
                    'filename' => basename($file),
                    'created_at' => date('Y-m-d H:i:s', Storage::disk('local')->lastModified($file)),
                ];
            })
            ->sortByDesc('created_at')
            ->values()
            ->all();

        // Возвращаем список в формате JSON для API или в виде массива для веб
        if (request()->wantsJson()) {
            return response()->json($backups);
        }

        return view('backups.index', compact('backups'));
    }

    /**
     * Восстановление базы данных из резервной копии.
     *
     * @param  string  $filename
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        // Получаем имя файла из тела запроса
        $filename = $request->input('filename');

        // Проверяем, существует ли файл
        if (!Storage::disk('local')->exists("backups/{$filename}")) {
            return response()->json(['error' => 'Файл резервной копии не найден'], 404);
        }

        // Логика восстановления базы данных
        $backupFilePath = storage_path("app/backups/{$filename}");

        // Команда pg_restore для восстановления базы данных
        $dbName = config('database.connections.pgsql.database');
        $dbUser = config('database.connections.pgsql.username');
        $dbPassword = config('database.connections.pgsql.password');
        $dbHost = config('database.connections.pgsql.host');
        $dbPort = config('database.connections.pgsql.port');

        $command = sprintf(
            'PGPASSWORD=%s pg_restore -U %s -h %s -p %s -d %s %s',
            escapeshellarg($dbPassword),
            escapeshellarg($dbUser),
            escapeshellarg($dbHost),
            escapeshellarg($dbPort),
            escapeshellarg($dbName),
            escapeshellarg($backupFilePath)
        );

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            return response()->json(['message' => 'База данных успешно восстановлена']);
        } else {
            return response()->json(['error' => 'Ошибка при восстановлении базы данных'], 500);
        }
    }

    /**
     * Создание новой резервной копии.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Указываем директорию для сохранения резервной копии
        $backupPath = storage_path('app/private/backups/');
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        // Формируем имя файла резервной копии
        $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $backupFilePath = $backupPath . $backupFileName;

        // Команда pg_dump для создания резервной копии
        $dbName = config('database.connections.pgsql.database');
        $dbUser = config('database.connections.pgsql.username');
        $dbPassword = config('database.connections.pgsql.password');
        $dbHost = config('database.connections.pgsql.host');
        $dbPort = config('database.connections.pgsql.port');

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
        exec($command, $output, $returnVar);

        // Проверяем результат выполнения команды
        if ($returnVar === 0) {
            // Если это API-запрос, возвращаем JSON-ответ
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Резервная копия успешно создана'], 200);
            }

            // Если это веб-запрос, выполняем перенаправление
            return redirect()->route('dashboard.backups')->with('success', 'Резервная копия успешно создана');
        } else {
            // Если это API-запрос, возвращаем JSON-ответ
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Ошибка при создании резервной копии'], 500);
            }

            // Если это веб-запрос, выполняем перенаправление
            return redirect()->route('dashboard.backups')->with('error', 'Ошибка при создании резервной копии');
        }
    }
}
