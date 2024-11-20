<?php

namespace Database\Seeders;

use App\Models\Department;
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
        $head = Employee::find(1);
        $department = Department::find(1);

        // Привязка процесса к сотруднику
        $head->departments()->attach($department, ['start_date' => now(), 'end_date' => null]);

        $methodist = Employee::find(2);
        $department = Department::find(4);

        // Привязка процесса к сотруднику
        $methodist->departments()->attach($department, ['start_date' => now(), 'end_date' => null]);

        $employee = Employee::find(3);
        $department = Department::find(3);

        // Привязка процесса к сотруднику
        $employee->departments()->attach($department, ['start_date' => now(), 'end_date' => null]);
    }
}
