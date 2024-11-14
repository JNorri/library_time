<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Process;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeDepartmentSeeder extends Seeder
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
        $employee->departments()->attach($process, ['start_date' => now(), 'end_date' => null]);
    }
}
