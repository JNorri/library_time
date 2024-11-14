<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Сброс кэшированных ролей и разрешений
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Создание разрешений
        $editArticles       = Permission::firstOrCreate(['name' => 'edit articles']);
        $deleteArticles     = Permission::firstOrCreate(['name' => 'delete articles']);
        $viewArticles       = Permission::firstOrCreate(['name' => 'view articles']);
        $publishArticles    = Permission::firstOrCreate(['name' => 'publish articles']);

        // Создание ролей и назначение разрешений
        $headOfDepartment = Role::create(['name' => 'Заведующий отделом']);
        $headOfDepartment->givePermissionTo(Permission::all());

        $methodist = Role::create(['name' => 'Методист']);
        $methodist->givePermissionTo(Permission::all());

        $employee = Role::create(['name' => 'Сотрудник']);
        $employee->givePermissionTo([$editArticles, $deleteArticles]);
    }
}
