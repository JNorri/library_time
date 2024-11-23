<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleLogPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получение ролей и разрешений
        $roles = Role::all();
        $permissions = Permission::all();

        // Привязка разрешений к ролям
        foreach ($roles as $role) {
            // Выбираем случайное количество разрешений (от 1 до 5)
            $randomPermissions = $permissions->random(rand(1, 5));
            foreach ($randomPermissions as $permission) {
                $this->assignPermissionToRole($role->role_id, $permission->permission_id);
            }
        }
    }

    /**
     * Назначение разрешения роли.
     *
     * @param int $roleId
     * @param int $permissionId
     */
    private function assignPermissionToRole(int $roleId, int $permissionId): void
    {
        DB::table('role_log_permission')->insert([
            'role_id' => $roleId,
            'permission_id' => $permissionId,
        ]);
    }
}
