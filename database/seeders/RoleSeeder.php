<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            // Роли пользователей
            $roles = [
                ['role_name' => 'Заведующий отделом', 'role_description' => 'test', 'slug' => 'head_department'],
                ['role_name' => 'Методист', 'role_description' => 'test', 'slug' => 'methodist'],
                ['role_name' => 'Сотрудник', 'role_description' => 'test', 'slug' => 'employee'],
            ];

            foreach ($roles as $roleData) {
                $role = Role::firstOrCreate($roleData);
                Log::info("Роль '{$role->role_name}' создана.");

                // Назначение разрешений роли (например, для "Заведующий отделом")
                if ($role->slug === 'head_department') {
                    $permissions = Permission::whereIn('slug', [
                        'view_data_report',
                        'edit_data_report',
                        'view_employee',
                        'edit_employee',
                        'view_department',
                        'edit_department',
                    ])->get();

                    $role->permissions()->sync($permissions->pluck('permission_id')->toArray());
                    Log::info("Разрешения назначены роли '{$role->role_name}'.");
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Ошибка при заполнении ролей: {$e->getMessage()}");
        }
    }
}