<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Process;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSpecificProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем всех сотрудников
        $employees = Employee::all();

        // Получаем все ежедневные процессы
        $dailyProcesses = Process::where('is_daily', true)->get();

        // Создаем массив для хранения данных
        $data = [];

        // Генерируем данные для каждого сотрудника
        foreach ($employees as $employee) {
            // Генерируем ежедневные процессы за разные даты
            for ($i = 0; $i < 10; $i++) { // У каждого сотрудника будет 10 ежедневных процессов
                $date = now()->subDays(rand(0, 30)); // Случайная дата в прошлом (от 0 до 30 дней назад)

                foreach ($dailyProcesses as $process) {
                    // Определяем описание, если процесс требует описания
                    $description = $process->require_description ? "Описание процесса {$process->process_name}" : null;

                    // Добавляем данные в массив
                    $data[] = [
                        'employee_id' => $employee->employee_id,
                        'process_id' => $process->process_id,
                        'date' => $date,
                        'quantity' => 1, // Для ежедневных процессов quantity = 1
                        'description' => $description,
                    ];
                }
            }

            // Добавляем случайные процессы (не ежедневные) для каждого сотрудника
            $nonDailyProcesses = Process::where('is_daily', false)->get()->random(rand(5, 10));
            foreach ($nonDailyProcesses as $process) {
                // Определяем дату (текущая дата или случайная дата в прошлом)
                $date = now()->subDays(rand(0, 30));

                // Определяем количество (случайное число от 1 до 5)
                $quantity = rand(1, 5);

                // Определяем описание, если процесс требует описания
                $description = $process->require_description ? "Описание процесса {$process->process_name}" : null;

                // Добавляем данные в массив
                $data[] = [
                    'employee_id' => $employee->employee_id,
                    'process_id' => $process->process_id,
                    'date' => $date,
                    'quantity' => $quantity,
                    'description' => $description,
                ];
            }
        }

        // Вставляем данные в таблицу
        DB::table('employee_specific_process')->insert($data);
    }
}