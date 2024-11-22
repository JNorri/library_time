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
        $this->call(EmployeeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleLogPermissionSeeder::class);
        $this->call(MeasurementSeeder::class);
        $this->call(EmployeeLogRoleSeeder::class);
        $this->call(ProcessSeeder::class);
        $this->call(EmployeeLogProcessSeeder::class);
        $this->call(EmployeeLogDepartmentSeeder::class);
        $this->call(EmployeeSpecificProcessSeeder::class);

        // $this->call(Role::class);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
