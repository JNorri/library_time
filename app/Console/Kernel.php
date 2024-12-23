<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\BackupDatabase::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Полное резервное копирование (еженедельно)
        $schedule->command('db:backup --full')->weekly()->mondays()->at('01:54');

        // Добавьте другие задачи, если необходимо
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}