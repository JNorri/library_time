<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserLogRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получение сотрудника и процесса
        $user = User::find(1);
        $role = Role::find(1);

        // Привязка роли к сотруднику
        $user->roles()->attach($role);
    }
}
