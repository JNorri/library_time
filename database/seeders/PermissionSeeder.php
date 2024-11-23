<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['permission_name' => 'Просмотр данных отчёта', 'slug' => 'view_data_report', 'permission_description' => 'Разрешение на просмотр данных отчёта'],
            ['permission_name' => 'Просмотр данных сотрудника', 'slug' => 'view_employee', 'permission_description' => 'Разрешение на просмотр данных сотрудника'],
            ['permission_name' => 'Редактирование данных отчёта', 'slug' => 'edit_data_report', 'permission_description' => 'Разрешение на редактирование данных отчёта'],
            ['permission_name' => 'Редактирование данных сотрудника', 'slug' => 'edit_employee', 'permission_description' => 'Разрешение на редактирование данных сотрудника'],
            ['permission_name' => 'Удаление данных отчёта', 'slug' => 'delete_data_report', 'permission_description' => 'Разрешение на удаление данных отчёта'],
            ['permission_name' => 'Удаление данных сотрудника', 'slug' => 'delete_employee', 'permission_description' => 'Разрешение на удаление данных сотрудника'],
            ['permission_name' => 'Создание данных отчёта', 'slug' => 'create_data_report', 'permission_description' => 'Разрешение на создание данных отчёта'],
            ['permission_name' => 'Создание данных сотрудника', 'slug' => 'create_employee', 'permission_description' => 'Разрешение на создание данных сотрудника'],
            ['permission_name' => 'Просмотр данных отдела', 'slug' => 'view_department', 'permission_description' => 'Разрешение на просмотр данных отдела'],
            ['permission_name' => 'Редактирование данных отдела', 'slug' => 'edit_department', 'permission_description' => 'Разрешение на редактирование данных отдела'],
            ['permission_name' => 'Удаление данных отдела', 'slug' => 'delete_department', 'permission_description' => 'Разрешение на удаление данных отдела'],
            ['permission_name' => 'Создание данных отдела', 'slug' => 'create_department', 'permission_description' => 'Разрешение на создание данных отдела'],
            ['permission_name' => 'Просмотр данных процесса', 'slug' => 'view_process', 'permission_description' => 'Разрешение на просмотр данных процесса'],
            ['permission_name' => 'Редактирование данных процесса', 'slug' => 'edit_process', 'permission_description' => 'Разрешение на редактирование данных процесса'],
            ['permission_name' => 'Удаление данных процесса', 'slug' => 'delete_process', 'permission_description' => 'Разрешение на удаление данных процесса'],
            ['permission_name' => 'Создание данных процесса', 'slug' => 'create_process', 'permission_description' => 'Разрешение на создание данных процесса'],
            ['permission_name' => 'Просмотр данных роли', 'slug' => 'view_role', 'permission_description' => 'Разрешение на просмотр данных роли'],
            ['permission_name' => 'Редактирование данных роли', 'slug' => 'edit_role', 'permission_description' => 'Разрешение на редактирование данных роли'],
            ['permission_name' => 'Удаление данных роли', 'slug' => 'delete_role', 'permission_description' => 'Разрешение на удаление данных роли'],
            ['permission_name' => 'Создание данных роли', 'slug' => 'create_role', 'permission_description' => 'Разрешение на создание данных роли'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
