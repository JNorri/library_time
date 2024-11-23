<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Process;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSpecificProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Примеры назначения процессов конкретным сотрудникам
        $this->assignProcessesToEmployee(1, 1, now(), 1, 'Описание количественного процесса');
        $this->assignProcessesToEmployee(2, 2, now(), 2, 'Описание не количественного процесса');
        $this->assignProcessesToEmployee(3, 3, now(), 3, 'Описание ежедневного процесса');
    }

    /**
     * Назначение процесса сотруднику.
     *
     * @param int $employeeId
     * @param int $processId
     * @param string $date
     * @param int $quantity
     * @param string|null $description
     */
    private function assignProcessesToEmployee(int $employeeId, int $processId, string $date, int $quantity, ?string $description): void
    {
        DB::table('employee_specific_process')->insert([
            'employee_id' => $employeeId,
            'process_id' => $processId,
            'date' => $date,
            'quantity' => $quantity,
            'description' => $description,
        ]);
    }
}
