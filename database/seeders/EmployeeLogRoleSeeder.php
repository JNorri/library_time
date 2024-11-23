<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeLogRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получение сотрудников
        $employees = Employee::all();

        // Получение ролей
        $roles = Role::all();

        // Привязка ролей к сотрудникам
        foreach ($employees as $employee) {
            // Выбираем одну активную роль
            $activeRole = $roles->random();
            $this->assignRoleToEmployee($employee->employee_id, $activeRole->role_id);

            // Выбираем случайное количество дополнительных ролей (от 0 до 3)
            $additionalRoles = $roles->random(rand(0, 3));
            foreach ($additionalRoles as $role) {
                // Проверяем, чтобы не назначить ту же роль, что и активная
                if ($role->role_id !== $activeRole->role_id) {
                    $this->assignRoleToEmployee($employee->employee_id, $role->role_id);
                }
            }
        }
    }

    /**
     * Назначение роли сотруднику.
     *
     * @param int $employeeId
     * @param int $roleId
     */
    private function assignRoleToEmployee(int $employeeId, int $roleId): void
    {
        DB::table('employee_log_role')->insert([
            'employee_id' => $employeeId,
            'role_id' => $roleId,
        ]);
    }
}
