<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeLogDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Получаем всех пользователей и департаменты
        // $users = User::all();
        // $departments = Department::all();

        // // Для каждого пользователя добавляем случайные департаменты
        // foreach ($users as $user) {
        //     // Выбираем случайное количество департаментов (например, от 1 до 3)
        //     $randomDepartments = $departments->random(rand(1, 3));

        //     // Присоединяем выбранные департаменты к пользователю
        //     foreach ($randomDepartments as $department) {
        //         $user->departments()->attach($department->department_id, [
        //             'start_date' => now(),
        //             'end_date' => null, // или дату окончания, если она есть
        //         ]);
        //     }
        // }
        // Получение сотрудника и процесса
        $head = Employee::find(1);
        $department = Department::find(1);

        // Привязка процесса к сотруднику
        $head->departments()->attach($department, ['start_date' => now(), 'end_date' => null]);

        $methodist = Employee::find(2);
        $department = Department::find(4);

        // Привязка процесса к сотруднику
        $methodist->departments()->attach($department, ['start_date' => now(), 'end_date' => null]);

        $employee = Employee::find(3);
        $department = Department::find(3);

        // Привязка процесса к сотруднику
        $employee->departments()->attach($department, ['start_date' => now(), 'end_date' => null]);
    }
}
