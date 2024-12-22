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

        
        
            DB::table('roles')->insert($roles);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Ошибка при заполнении ролей: {$e->getMessage()}");
        }
    }
}
