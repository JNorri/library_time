<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleLogPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            // Получение всех ролей и разрешений
            $roles = Role::all();
            $permissions = Permission::all();

            // Назначение разрешений для каждой роли
            foreach ($roles as $role) {
                if (!$role->role_id) {
                    Log::error("Роль '{$role->role_name}' не имеет идентификатора (role_id). Пропуск назначения разрешений.");
                    continue; // Пропустить роль, если role_id отсутствует
                }

                if ($role->slug === 'head_department') {
                    // Назначение всех разрешений для "Заведующий отделом"
                    $this->assignAllPermissionsToRole($role->role_id, $permissions);
                    Log::info("Все разрешения назначены роли '{$role->role_name}'.");
                } else {
                    // Назначение случайных разрешений для остальных ролей
                    $randomPermissions = $permissions->random(rand(1, 5));
                    $this->assignPermissionsToRole($role->role_id, $randomPermissions->pluck('permission_id')->toArray());
                    Log::info("Случайные разрешения назначены роли '{$role->role_name}'.");
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Ошибка при назначении разрешений: {$e->getMessage()}");
        }
    }

    /**
     * Назначение всех разрешений роли.
     *
     * @param int $roleId
     * @param \Illuminate\Database\Eloquent\Collection $permissions
     */
    private function assignAllPermissionsToRole(int $roleId, $permissions): void
    {
        $permissionIds = $permissions->pluck('permission_id')->toArray();
        $this->assignPermissionsToRole($roleId, $permissionIds);
    }

    /**
     * Назначение разрешений роли.
     *
     * @param int $roleId
     * @param array $permissionIds
     */
    private function assignPermissionsToRole(int $roleId, array $permissionIds): void
    {
        foreach ($permissionIds as $permissionId) {
            DB::table('role_log_permission')->insert([
                'role_id' => $roleId,
                'permission_id' => $permissionId,
            ]);
        }
    }
}
