<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeLogDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получение сотрудников
        $employees = Employee::all();

        // Получение отделов
        $departments = Department::all();

        // Привязка отделов к сотрудникам
        foreach ($employees as $employee) {
            // Выбираем один активный отдел (end_date = null)
            $activeDepartment = $departments->random();
            $this->assignDepartmentToEmployee($employee->employee_id, $activeDepartment->department_id, now(), null);

            // Выбираем случайное количество дополнительных отделов (от 0 до 3)
            $additionalDepartments = $departments->random(rand(0, 3));
            foreach ($additionalDepartments as $department) {
                // Проверяем, чтобы не назначить тот же отдел, что и активный
                if ($department->department_id !== $activeDepartment->department_id) {
                    // Привязка дополнительного отдела с указанием end_date
                    $this->assignDepartmentToEmployee($employee->employee_id, $department->department_id, now(), now()->addDays(rand(1, 30)));
                }
            }
        }
    }

    /**
     * Назначение отдела сотруднику.
     *
     * @param int $employeeId
     * @param int $departmentId
     * @param string $startDate
     * @param string|null $endDate
     */
    private function assignDepartmentToEmployee(int $employeeId, int $departmentId, string $startDate, ?string $endDate): void
    {
        DB::table('employee_log_department')->insert([
            'employee_id' => $employeeId,
            'department_id' => $departmentId,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }
}
