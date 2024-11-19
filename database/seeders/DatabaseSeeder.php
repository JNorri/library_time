<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Measurement;
use App\Models\Process;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DepartmentSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(MeasurementSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(EmployeeRoleSeeder::class);
        $this->call(ProcessSeeder::class);
        $this->call(EmployeeProcessSeeder::class);
        $this->call(ProcessEmployeeSeeder::class);
        $this->call(EmployeeDepartmentSeeder::class);

        // $this->call(Role::class);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
