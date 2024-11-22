<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Process;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSpecificProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получение сотрудника и процесса
        $user = User::find(1);
        $process = Process::find(1);

        // Привязка процесса к сотруднику
        $process->users()->attach($user, ['date' => now(), 'quantity' => 1, 'description' => 'Описание']);
    }
}
