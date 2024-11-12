<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Уровень привелегий
        $headDepartment = Role::create(array(
            'role_name' => 'Заведующий отделом'
        ));

        $moderator_level = Role::create(array(
            'role_name' => 'Методист'
        ));

        $user_level = Role::create(array(
            'role_name' => 'Сотрудник'
        ));
    }
}
