<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeLogRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получение сотрудника и процесса
        $employee = Employee::find(1);
        $role = Role::find(1);

        // Привязка роли к сотруднику
        $employee->roles()->attach($role);
    }
}
