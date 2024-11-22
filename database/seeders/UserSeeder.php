<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\VarDumper;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userHeadDepartment = User::create(array(
            'first_name' => 'Александр',
            'middle_name' => 'Вячеславович',
            'last_name' => 'Аточин',
            'date_of_birth' => '1999-05-12',
            'email' => 'atochin99@mail.ru',
            'phone' => '+7 (951) 629-70-70',
            'password' => Hash::make('atochin12345'),
        ));


        $userHeadDepartment = User::create(array(
            'first_name' => 'Вячеслав',
            'middle_name' => 'Борисович',
            'last_name' => 'Ложников',
            'date_of_birth' => '1999-01-12',
            'email' => 'vyachesLUV@mail.ru',
            'phone' => '+7 (999) 456-70-52',
            'password' => Hash::make('lozhnikov12345'),
        ));


        $userHeadDepartment = User::create(array(
            'first_name' => 'Маруся',
            'middle_name' => 'Александровна',
            'last_name' => 'Лопатина',
            'date_of_birth' => '1995-04-14',
            'email' => 'lopata@mail.ru',
            'phone' => '+7 (983) 630-86-70',
            'password' => Hash::make('lopata12345'),
        ));
    }
}
