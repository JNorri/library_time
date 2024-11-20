<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $main_parent = Department::create(array(
            'department_name' => 'Научная библиотека',
            'department_description' => 'Тестовое описание',
            'parent_id' => null,
        ));

        $general = Department::create(array(
            'department_name' => 'Общие',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $scientificMethodological = Department::create(array(
            'department_name' => 'Научно-методический отдел',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $informationBibliographic = Department::create(array(
            'department_name' => 'Информационно-библиографический отдел',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $acquisitionScientific = Department::create(array(
            'department_name' => 'Отдел комплектования и научной обработки фондов',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $mainBookStorage = Department::create(array(
            'department_name' => 'Отдел основного книгохранения',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $nationalLocalHistory = Department::create(array(
            'department_name' => 'Отдел национальной и краеведческой литературы',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $publicationStatistics = Department::create(array(
            'department_name' => 'Отдел учета публикационной статистики',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $scientificLiterature = Department::create(array(
            'department_name' => 'Отдел обслуживания научной литературой',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $educationalFictionLiterature  = Department::create(array(
            'department_name' => 'Отдел обслуживания учебной и художественной литературой',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $directorate = Department::create(array(
            'department_name' => 'Дирекция',
            'department_description' => 'Тестовое описание',
            'parent_id' => $main_parent->department_id,
        ));

        $informationBibliographic = Department::create(array(
            'department_name' => 'Сектор информационно-библиографической и наукометрической работы',
            'department_description' => 'Тестовое описание',
            'parent_id' => $scientificMethodological->department_id,
        ));

        $bookSupply = Department::create(array(
            'department_name' => 'Сектор книгообеспеченности',
            'department_description' => 'Тестовое описание',
            'parent_id' => $acquisitionScientific->department_id,
        ));

        $recruitment = Department::create(array(
            'department_name' => 'Сектор комплектования',
            'department_description' => 'Тестовое описание',
            'parent_id' => $acquisitionScientific->department_id,
        ));

        $fundsAccounting = Department::create(array(
            'department_name' => 'Сектор учета фондов',
            'department_description' => 'Тестовое описание',
            'parent_id' => $acquisitionScientific->department_id,
        ));

        $scientificProcessing = Department::create(array(
            'department_name' => 'Сектор научной обработки фондов',
            'department_description' => 'Тестовое описание',
            'parent_id' => $acquisitionScientific->department_id,
        ));

        $rareValuable = Department::create(array(
            'department_name' => 'Cектор редких и ценных изданий',
            'department_description' => 'Тестовое описание',
            'parent_id' => $educationalFictionLiterature->department_id,
        ));

        $reRegisterReader = Department::create(array(
            'department_name' => 'Cектор регистрации читателей',
            'department_description' => 'Тестовое описание',
            'parent_id' => $general->department_id,
        ));

        // $departments = [
        //     [
        //         'department_name' => 'Научная библиотека',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => null,
        //     ],
        //     [
        //         'department_name' => 'Общие',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1, // Предполагаем, что "Научная библиотека" будет иметь id = 1
        //     ],
        //     [
        //         'department_name' => 'Научно-методический отдел',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'department_name' => 'Информационно-библиографический отдел',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'department_name' => 'Отдел комплектования и научной обработки фондов',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'department_name' => 'Отдел основного книгохранения',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'department_name' => 'Отдел национальной и краеведческой литературы',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'department_name' => 'Отдел учета публикационной статистики',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'department_name' => 'Отдел обслуживания научной литературой',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'department_name' => 'Отдел обслуживания учебной и художественной литературой',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'department_name' => 'Дирекция',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 1,
        //     ],
        //     [
        //         'department_name' => 'Сектор информационно-библиографической и наукометрической работы',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 3, // Предполагаем, что "Научно-методический отдел" будет иметь id = 3
        //     ],
        //     [
        //         'department_name' => 'Сектор книгообеспеченности',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 5, // Предполагаем, что "Отдел комплектования и научной обработки фондов" будет иметь id = 5
        //     ],
        //     [
        //         'department_name' => 'Сектор комплектования',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 5,
        //     ],
        //     [
        //         'department_name' => 'Сектор учета фондов',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 5,
        //     ],
        //     [
        //         'department_name' => 'Сектор научной обработки фондов',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 5,
        //     ],
        //     [
        //         'department_name' => 'Cектор редких и ценных изданий',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 10, // Предполагаем, что "Отдел обслуживания учебной и художественной литературой" будет иметь id = 10
        //     ],
        //     [
        //         'department_name' => 'Cектор регистрации читателей',
        //         'department_description' => 'Тестовое описание',
        //         'parent_id' => 2, // Предполагаем, что "Общие" будет иметь id = 2
        //     ],
        // ];

        // DB::table('departments')->insert($departments);
    }
}
