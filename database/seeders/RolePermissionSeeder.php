<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Role::find(1);
        $permission = Permission::find(1);

        $viewDataReport = Permission::firstOrCreate(['permission_name' => 'Просмотр данных отчёта', 'slug' => 'view_data_report', 'permission_description' => 'test']);
        $viewEmployee = Permission::firstOrCreate(['permission_name' => 'Просмотр данных сотрудника', 'slug' => 'view_employee', 'permission_description' => 'test']);

        $role->permissions()->attach([$viewDataReport->permission_id, $viewEmployee->permission_id]);
    }
}
