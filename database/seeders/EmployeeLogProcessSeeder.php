<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Process;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeLogProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Получение сотрудника и процесса
        $employee = Employee::find(1);
        $process = Process::find(1);

        // Привязка процесса к сотруднику
        if ($employee && $process) {
            // Привязка процесса к сотруднику
            $employee->processes()->attach($process, ['start_date' => now(), 'end_date' => null]);
        } else {
            // Обработка случая, когда сотрудник или процесс не найдены
            echo "Сотрудник или процесс не найдены.";
        }
    }
}
