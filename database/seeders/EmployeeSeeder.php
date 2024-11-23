<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\VarDumper;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Александр',
            'middle_name' => 'Вячеславович',
            'last_name' => 'Аточин',
            'date_of_birth' => '1999-05-12',
            'email' => 'atochin99@mail.ru',
            'phone' => '+7 (951) 629-70-70',
            'password' => Hash::make('atochin12345'),
        ));


        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Вячеслав',
            'middle_name' => 'Борисович',
            'last_name' => 'Ложников',
            'date_of_birth' => '1999-01-12',
            'email' => 'vyachesLUV@mail.ru',
            'phone' => '+7 (999) 456-70-52',
            'password' => Hash::make('lozhnikov12345'),
        ));


        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Маруся',
            'middle_name' => 'Александровна',
            'last_name' => 'Лопатина',
            'date_of_birth' => '1995-04-14',
            'email' => 'lopata@mail.ru',
            'phone' => '+7 (983) 630-86-70',
            'password' => Hash::make('lopata12345'),
        ));


        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Иван',
            'middle_name' => 'Иванович',
            'last_name' => 'Иванов',
            'date_of_birth' => '1985-03-15',
            'email' => 'ivanov@mail.ru',
            'phone' => '+7 (912) 345-67-89',
            'password' => Hash::make('ivanov12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Петр',
            'middle_name' => 'Петрович',
            'last_name' => 'Петров',
            'date_of_birth' => '1980-07-22',
            'email' => 'petrov@mail.ru',
            'phone' => '+7 (923) 456-78-90',
            'password' => Hash::make('petrov12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Сергей',
            'middle_name' => 'Сергеевич',
            'last_name' => 'Сергеев',
            'date_of_birth' => '1990-11-30',
            'email' => 'sergeev@mail.ru',
            'phone' => '+7 (934) 567-89-01',
            'password' => Hash::make('sergeev12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Алексей',
            'middle_name' => 'Алексеевич',
            'last_name' => 'Алексеев',
            'date_of_birth' => '1988-09-18',
            'email' => 'alekseev@mail.ru',
            'phone' => '+7 (945) 678-90-12',
            'password' => Hash::make('alekseev12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Дмитрий',
            'middle_name' => 'Дмитриевич',
            'last_name' => 'Дмитриев',
            'date_of_birth' => '1992-06-25',
            'email' => 'dmitriev@mail.ru',
            'phone' => '+7 (956) 789-01-23',
            'password' => Hash::make('dmitriev12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Николай',
            'middle_name' => 'Николаевич',
            'last_name' => 'Николаев',
            'date_of_birth' => '1987-04-10',
            'email' => 'nikolaev@mail.ru',
            'phone' => '+7 (967) 890-12-34',
            'password' => Hash::make('nikolaev12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Анна',
            'middle_name' => 'Андреевна',
            'last_name' => 'Андреева',
            'date_of_birth' => '1995-08-12',
            'email' => 'andreeva@mail.ru',
            'phone' => '+7 (978) 901-23-45',
            'password' => Hash::make('andreeva12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Елена',
            'middle_name' => 'Евгеньевна',
            'last_name' => 'Евгеньева',
            'date_of_birth' => '1993-12-05',
            'email' => 'evgeneva@mail.ru',
            'phone' => '+7 (989) 012-34-56',
            'password' => Hash::make('evgeneva12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Ольга',
            'middle_name' => 'Олеговна',
            'last_name' => 'Олегова',
            'date_of_birth' => '1991-02-28',
            'email' => 'olegova@mail.ru',
            'phone' => '+7 (990) 123-45-67',
            'password' => Hash::make('olegova12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Татьяна',
            'middle_name' => 'Тимофеевна',
            'last_name' => 'Тимофеева',
            'date_of_birth' => '1989-10-14',
            'email' => 'timofeeva@mail.ru',
            'phone' => '+7 (901) 234-56-78',
            'password' => Hash::make('timofeeva12345'),
        ));
    }
}
