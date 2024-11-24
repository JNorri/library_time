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
            'phone' => '+7 (912) 345-67-90',
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
            'phone' => '+7 (934) 567-89-03',
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
            'phone' => '+7 (967) 890-12-31',
            'password' => Hash::make('nikolaev12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Анна',
            'middle_name' => 'Андреевна',
            'last_name' => 'Андреева',
            'date_of_birth' => '1995-08-12',
            'email' => 'andreeva@mail.ru',
            'phone' => '+7 (978) 901-23-43',
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

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Михаил',
            'middle_name' => 'Михайлович',
            'last_name' => 'Михайлов',
            'date_of_birth' => '1994-07-20',
            'email' => 'mikhailov@mail.ru',
            'phone' => '+7 (912) 345-67-89',
            'password' => Hash::make('mikhailov12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Екатерина',
            'middle_name' => 'Евгеньевна',
            'last_name' => 'Евгеньева',
            'date_of_birth' => '1996-09-25',
            'email' => 'evgeneva2@mail.ru',
            'phone' => '+7 (923) 456-78-99',
            'password' => Hash::make('evgeneva212345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Андрей',
            'middle_name' => 'Андреевич',
            'last_name' => 'Андреев',
            'date_of_birth' => '1997-11-18',
            'email' => 'andreev@mail.ru',
            'phone' => '+7 (934) 567-89-11',
            'password' => Hash::make('andreev12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Наталья',
            'middle_name' => 'Николаевна',
            'last_name' => 'Николаева',
            'date_of_birth' => '1998-03-12',
            'email' => 'nikolaeva@mail.ru',
            'phone' => '+7 (945) 678-90-11',
            'password' => Hash::make('nikolaeva12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Владимир',
            'middle_name' => 'Владимирович',
            'last_name' => 'Владимиров',
            'date_of_birth' => '1999-05-28',
            'email' => 'vladimirov@mail.ru',
            'phone' => '+7 (956) 789-01-22',
            'password' => Hash::make('vladimirov12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Светлана',
            'middle_name' => 'Сергеевна',
            'last_name' => 'Сергеева',
            'date_of_birth' => '1993-08-14',
            'email' => 'sergeeva@mail.ru',
            'phone' => '+7 (967) 890-12-34',
            'password' => Hash::make('sergeeva12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Игорь',
            'middle_name' => 'Игоревич',
            'last_name' => 'Игорев',
            'date_of_birth' => '1994-10-02',
            'email' => 'igorev@mail.ru',
            'phone' => '+7 (978) 901-23-45',
            'password' => Hash::make('igorev12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Людмила',
            'middle_name' => 'Леонидовна',
            'last_name' => 'Леонидова',
            'date_of_birth' => '1995-12-20',
            'email' => 'leonidova@mail.ru',
            'phone' => '+7 (989) 012-34-55',
            'password' => Hash::make('leonidova12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Георгий',
            'middle_name' => 'Георгиевич',
            'last_name' => 'Георгиев',
            'date_of_birth' => '1996-02-28',
            'email' => 'georgiev@mail.ru',
            'phone' => '+7 (990) 123-45-69',
            'password' => Hash::make('georgiev12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Оксана',
            'middle_name' => 'Олеговна',
            'last_name' => 'Олегова',
            'date_of_birth' => '1997-04-15',
            'email' => 'olegova2@mail.ru',
            'phone' => '+7 (901) 234-56-73',
            'password' => Hash::make('olegova212345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Павел',
            'middle_name' => 'Павлович',
            'last_name' => 'Павлов',
            'date_of_birth' => '1998-06-22',
            'email' => 'pavlov@mail.ru',
            'phone' => '+7 (912) 345-67-88',
            'password' => Hash::make('pavlov12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Юлия',
            'middle_name' => 'Юрьевна',
            'last_name' => 'Юрьева',
            'date_of_birth' => '1999-08-30',
            'email' => 'yurieva@mail.ru',
            'phone' => '+7 (923) 456-78-95',
            'password' => Hash::make('yurieva12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Виктор',
            'middle_name' => 'Викторович',
            'last_name' => 'Викторов',
            'date_of_birth' => '1993-10-10',
            'email' => 'viktorov@mail.ru',
            'phone' => '+7 (934) 567-89-01',
            'password' => Hash::make('viktorov12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Мария',
            'middle_name' => 'Михайловна',
            'last_name' => 'Михайлова',
            'date_of_birth' => '1994-12-18',
            'email' => 'mikhailova@mail.ru',
            'phone' => '+7 (945) 678-90-10',
            'password' => Hash::make('mikhailova12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Денис',
            'middle_name' => 'Денисович',
            'last_name' => 'Денисов',
            'date_of_birth' => '1995-02-25',
            'email' => 'denisov@mail.ru',
            'phone' => '+7 (956) 789-01-24',
            'password' => Hash::make('denisov12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Евгений',
            'middle_name' => 'Евгеньевич',
            'last_name' => 'Евгеньев',
            'date_of_birth' => '1992-04-15',
            'email' => 'evgeniev@mail.ru',
            'phone' => '+7 (967) 890-12-35',
            'password' => Hash::make('evgeniev12345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Надежда',
            'middle_name' => 'Николаевна',
            'last_name' => 'Николаева',
            'date_of_birth' => '1993-06-20',
            'email' => 'nikolaeva2@mail.ru',
            'phone' => '+7 (978) 901-23-46',
            'password' => Hash::make('nikolaeva212345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Сергей',
            'middle_name' => 'Сергеевич',
            'last_name' => 'Сергеев',
            'date_of_birth' => '1994-08-25',
            'email' => 'sergeev2@mail.ru',
            'phone' => '+7 (989) 012-34-57',
            'password' => Hash::make('sergeev212345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Ольга',
            'middle_name' => 'Олеговна',
            'last_name' => 'Олегова',
            'date_of_birth' => '1995-10-30',
            'email' => 'olegova3@mail.ru',
            'phone' => '+7 (990) 123-45-68',
            'password' => Hash::make('olegova312345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Андрей',
            'middle_name' => 'Андреевич',
            'last_name' => 'Андреев',
            'date_of_birth' => '1996-12-05',
            'email' => 'andreev2@mail.ru',
            'phone' => '+7 (901) 234-56-79',
            'password' => Hash::make('andreev212345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Татьяна',
            'middle_name' => 'Тимофеевна',
            'last_name' => 'Тимофеева',
            'date_of_birth' => '1997-02-10',
            'email' => 'timofeeva2@mail.ru',
            'phone' => '+7 (912) 345-67-80',
            'password' => Hash::make('timofeeva212345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Игорь',
            'middle_name' => 'Игоревич',
            'last_name' => 'Игорев',
            'date_of_birth' => '1998-04-15',
            'email' => 'igorev2@mail.ru',
            'phone' => '+7 (923) 456-78-91',
            'password' => Hash::make('igorev212345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Людмила',
            'middle_name' => 'Леонидовна',
            'last_name' => 'Леонидова',
            'date_of_birth' => '1999-06-20',
            'email' => 'leonidova2@mail.ru',
            'phone' => '+7 (934) 567-89-02',
            'password' => Hash::make('leonidova212345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Георгий',
            'middle_name' => 'Георгиевич',
            'last_name' => 'Георгиев',
            'date_of_birth' => '1992-08-25',
            'email' => 'georgiev2@mail.ru',
            'phone' => '+7 (945) 678-90-13',
            'password' => Hash::make('georgiev212345'),
        ));

        $userHeadDepartment = Employee::create(array(
            'first_name' => 'Оксана',
            'middle_name' => 'Олеговна',
            'last_name' => 'Олегова',
            'date_of_birth' => '1993-10-30',
            'email' => 'olegova4@mail.ru',
            'phone' => '+7 (956) 789-01-25',
            'password' => Hash::make('olegova412345'),
        ));
    }
}
