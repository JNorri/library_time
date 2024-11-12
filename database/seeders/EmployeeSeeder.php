<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
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
        // Отделы
        $scientificMethodological = Department::where('department_name', 'Научно-методический отдел')->first();

        // Секторы отделов
        $informationBibliographic = Sector::where('sector_name', 'Сектор информационно-библиографической и наукометрической работы')->first();        // Роли пользователей
        $rareValuable = Sector::where('sector_name', 'Cектор редких и ценных изданий')->first();

        // Роли пользователей
        $headDepartment = Role::where('role_name', 'Заведующий отделом')->first();
        $methodist = Role::where('role_name', 'Методист')->first();
        $employee = Role::where('role_name', 'Сотрудник')->first();

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Александр',
            'middle_name' => 'Вячеславович',
            'last_name' => 'Аточин',
            'date_of_birth' => '1999-05-12',
            'email' => 'atochin99@mail.ru',
            'phone' => '+7 (951) 629-70-70',
            'password' => Hash::make('atochin12345'),
            'role_id' => $headDepartment->id,
            'department_id' => $scientificMethodological->id,
            'sector_id' => null,
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Вячеслав',
            'middle_name' => 'Борисович',
            'last_name' => 'Ложников',
            'date_of_birth' => '1999-01-12',
            'email' => 'vyachesLUV@mail.ru',
            'phone' => '+7 (999) 456-70-52',
            'password' => Hash::make('lozhnikov12345'),
            'role_id' => $methodist->id,
            'department_id' => $informationBibliographic->department_id,
            'sector_id' => $informationBibliographic->id,
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Маруся',
            'middle_name' => 'Александровна',
            'last_name' => 'Лопатина',
            'date_of_birth' => '1995-04-14',
            'email' => 'lopata@mail.ru',
            'phone' => '+7 (983) 630-86-70',
            'password' => Hash::make('lopata12345'),
            'role_id' => $employee->id,
            'department_id' => $rareValuable->department_id,
            'sector_id' => $rareValuable->id,
        ));
    }
}
