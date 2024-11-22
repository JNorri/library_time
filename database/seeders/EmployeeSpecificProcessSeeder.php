<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Process;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSpecificProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получение сотрудника и процесса
        $employee = Employee::find(1);
        $process = Process::find(1);

        // Привязка процесса к сотруднику
        $process->employees()->attach($employee, ['date' => now(), 'quantity' => 1, 'description' => 'Описание']);
    }
}
