<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            $permissions = [
                ['permission_name' => 'Просмотр данных отчёта',             'slug' => 'view_data_report', 'permission_description' => 'Разрешение на просмотр данных отчёта'],
                ['permission_name' => 'Просмотр данных сотрудника',         'slug' => 'view_employee', 'permission_description' => 'Разрешение на просмотр данных сотрудника'],
                ['permission_name' => 'Редактирование данных отчёта',       'slug' => 'edit_data_report', 'permission_description' => 'Разрешение на редактирование данных отчёта'],
                ['permission_name' => 'Редактирование данных сотрудника',   'slug' => 'edit_employee', 'permission_description' => 'Разрешение на редактирование данных сотрудника'],
                ['permission_name' => 'Удаление данных отчёта',             'slug' => 'delete_data_report', 'permission_description' => 'Разрешение на удаление данных отчёта'],
                ['permission_name' => 'Удаление данных сотрудника',         'slug' => 'delete_employee', 'permission_description' => 'Разрешение на удаление данных сотрудника'],
                ['permission_name' => 'Создание данных отчёта',             'slug' => 'create_data_report', 'permission_description' => 'Разрешение на создание данных отчёта'],
                ['permission_name' => 'Создание данных сотрудника',         'slug' => 'create_employee', 'permission_description' => 'Разрешение на создание данных сотрудника'],
                ['permission_name' => 'Просмотр данных отдела',             'slug' => 'view_department', 'permission_description' => 'Разрешение на просмотр данных отдела'],
                ['permission_name' => 'Редактирование данных отдела',       'slug' => 'edit_department', 'permission_description' => 'Разрешение на редактирование данных отдела'],
                ['permission_name' => 'Удаление данных отдела',             'slug' => 'delete_department', 'permission_description' => 'Разрешение на удаление данных отдела'],
                ['permission_name' => 'Создание данных отдела',             'slug' => 'create_department', 'permission_description' => 'Разрешение на создание данных отдела'],
                ['permission_name' => 'Просмотр данных процесса',           'slug' => 'view_process', 'permission_description' => 'Разрешение на просмотр данных процесса'],
                ['permission_name' => 'Редактирование данных процесса',     'slug' => 'edit_process', 'permission_description' => 'Разрешение на редактирование данных процесса'],
                ['permission_name' => 'Удаление данных процесса',           'slug' => 'delete_process', 'permission_description' => 'Разрешение на удаление данных процесса'],
                ['permission_name' => 'Создание данных процесса',           'slug' => 'create_process', 'permission_description' => 'Разрешение на создание данных процесса'],
                ['permission_name' => 'Просмотр данных роли',               'slug' => 'view_role', 'permission_description' => 'Разрешение на просмотр данных роли'],
                ['permission_name' => 'Редактирование данных роли',         'slug' => 'edit_role', 'permission_description' => 'Разрешение на редактирование данных роли'],
                ['permission_name' => 'Удаление данных роли',               'slug' => 'delete_role', 'permission_description' => 'Разрешение на удаление данных роли'],
                ['permission_name' => 'Создание',               'slug' => 'create', 'permission_description' => 'Разрешение на создание данных роли'],
                ['permission_name' => 'Удаление',               'slug' => 'delete', 'permission_description' => 'Разрешение на удаление данных роли'],
                ['permission_name' => 'Просмотр чего-либо',               'slug' => 'view_any', 'permission_description' => 'Разрешение на просмотр чего-либо'],
                ['permission_name' => 'Просмотр',               'slug' => 'view', 'permission_description' => 'Разрешение на просмотр чего-либо'],
                ['permission_name' => 'Назначение',               'slug' => 'assign', 'permission_description' => 'Разрешение на назначение чего-либо'],
                ['permission_name' => 'Снятие',               'slug' => 'unassign', 'permission_description' => 'Разрешение на удаление чего-либо'],
            ];

            foreach ($permissions as $permission) {
                $existingPermission = Permission::where('slug', $permission['slug'])->first();

                if (!$existingPermission) {
                    Permission::create($permission);
                    Log::info("Разрешение '{$permission['permission_name']}' создано.");
                } else {
                    Log::info("Разрешение '{$permission['permission_name']}' уже существует.");
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Ошибка при заполнении разрешений: {$e->getMessage()}");
        }
    }
}
