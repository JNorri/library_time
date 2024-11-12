<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $general = Department::create(array(
            'department_name' => 'Общие'
        ));

        $scientificMethodological = Department::create(array(
            'department_name' => 'Научно-методический отдел'
        ));

        $informationBibliographic = Department::create(array(
            'department_name' => 'Информационно-библиографический отдел'
        ));

        $acquisitionScientific = Department::create(array(
            'department_name' => 'Отдел комплектования и научной обработки фондов'
        ));

        $mainBookStorage = Department::create(array(
            'department_name' => 'Отдел основного книгохранения'
        ));

        $nationalLocalHistory = Department::create(array(
            'department_name' => 'Отдел национальной и краеведческой литературы'
        ));

        $publicationStatistics = Department::create(array(
            'department_name' => 'Отдел учета публикационной статистики'
        ));

        $scientificLiterature = Department::create(array(
            'department_name' => 'Отдел обслуживания научной литературой'
        ));

        $educationalFictionLiterature  = Department::create(array(
            'department_name' => 'Отдел обслуживания учебной и художественной литературой'
        ));

        $directorate = Department::create(array(
            'department_name' => 'Дирекция'
        ));
    }
}
