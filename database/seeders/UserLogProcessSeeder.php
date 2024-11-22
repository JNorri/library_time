<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Process;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserLogProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Получение сотрудника и процесса
        $user = User::find(1);
        $process = Process::find(1);

        // Привязка процесса к сотруднику
        if ($user && $process) {
            // Привязка процесса к сотруднику
            $user->processes()->attach($process, ['start_date' => now(), 'end_date' => null]);
        } else {
            // Обработка случая, когда сотрудник или процесс не найдены
            echo "Сотрудник или процесс не найдены.";
        }
    }
}
