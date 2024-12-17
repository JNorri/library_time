<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\BackupDatabase::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Полное резервное копирование (еженедельно)
        $schedule->command('db:backup --full')->weekly()->mondays()->at('02:00');

        // Инкрементальное резервное копирование (ежедневно)
        $schedule->command('db:backup --incremental')->dailyAt('02:00');

        // Дифференциальное резервное копирование (ежедневно)
        $schedule->command('db:backup --differential')->dailyAt('01:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}