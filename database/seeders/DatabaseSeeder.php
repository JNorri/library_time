<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Measurement;
use App\Models\Process;
use App\Models\Role;
use App\Models\Sector;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Department::class);
        $this->call(Measurement::class);
        $this->call(Sector::class);
        $this->call(Role::class);
        $this->call(User::class);
        $this->call(Process::class);








        // $this->call(Role::class);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
