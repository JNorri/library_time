<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Process;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeLogProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получение сотрудников
        $employees = Employee::all();

        // Получение процессов
        $processes = Process::all();

        // Привязка процессов к сотрудникам
        foreach ($employees as $employee) {
            // Выбираем один активный процесс (end_date = null)
            $activeProcess = $processes->random();
            $this->assignProcessToEmployee($employee->employee_id, $activeProcess->process_id, now(), null);

            // Выбираем случайное количество дополнительных процессов (от 0 до 3)
            $additionalProcesses = $processes->random(rand(0, 3));
            foreach ($additionalProcesses as $process) {
                // Проверяем, чтобы не назначить тот же процесс, что и активный
                if ($process->process_id !== $activeProcess->process_id) {
                    // Привязка дополнительного процесса с указанием end_date
                    $this->assignProcessToEmployee($employee->employee_id, $process->process_id, now(), now()->addDays(rand(1, 30)));
                }
            }
        }
    }

    /**
     * Назначение процесса сотруднику.
     *
     * @param int $employeeId
     * @param int $processId
     * @param string $startDate
     * @param string|null $endDate
     */
    private function assignProcessToEmployee(int $employeeId, int $processId, string $startDate, ?string $endDate): void
    {
        DB::table('employee_log_process')->insert([
            'employee_id' => $employeeId,
            'process_id' => $processId,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }
}
