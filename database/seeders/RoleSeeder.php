<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Роли пользователей
        $headDepartment = Role::firstOrCreate(['role_name' => 'Заведующий отделом', 'role_description' => 'test', 'slug' => 'head_department']);
        $methodist      = Role::firstOrCreate(['role_name' => 'Методист', 'role_description' => 'test', 'slug' => 'methodist']);
        $employee       = Role::firstOrCreate(['role_name' => 'Сотрудник', 'role_description' => 'test', 'slug' => 'employee']);
    }
}
