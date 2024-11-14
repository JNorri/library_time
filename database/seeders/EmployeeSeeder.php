<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Роли пользователей
        $headDepartment = Role::where('name', 'Заведующий отделом')->first();
        $methodist      = Role::where('name', 'Методист')->first();
        $employee       = Role::where('name', 'Сотрудник')->first();

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Александр',
            'middle_name' => 'Вячеславович',
            'last_name' => 'Аточин',
            'date_of_birth' => '1999-05-12',
            'email' => 'atochin99@mail.ru',
            'phone' => '+7 (951) 629-70-70',
            'password' => Hash::make('atochin12345'),
        ));

        $userHeadDepartment->assignRole($headDepartment);

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Вячеслав',
            'middle_name' => 'Борисович',
            'last_name' => 'Ложников',
            'date_of_birth' => '1999-01-12',
            'email' => 'vyachesLUV@mail.ru',
            'phone' => '+7 (999) 456-70-52',
            'password' => Hash::make('lozhnikov12345'),
        ));

        $userHeadDepartment->assignRole($methodist);

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Маруся',
            'middle_name' => 'Александровна',
            'last_name' => 'Лопатина',
            'date_of_birth' => '1995-04-14',
            'email' => 'lopata@mail.ru',
            'phone' => '+7 (983) 630-86-70',
            'password' => Hash::make('lopata12345'),
        ));

        $userHeadDepartment->assignRole($employee);
    }
}
