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
        //
        // Пример разрешений
        $viewDataReport = Permission::firstOrCreate(['permission_name' => 'Просмотр данных отчёта', 'slug' => 'view_data_report', 'permission_description' => 'test']);
        $viewEmployee = Permission::firstOrCreate(['permission_name' => 'Просмотр данных сотрудника', 'slug' => 'view_employee', 'permission_description' => 'test']);
    }
}
