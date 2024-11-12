<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DepartmentSeeder;
use Random\Engine\Secure;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scientificMethodological = Department::where('department_name', 'Научно-методический отдел')->first();
        $acquisitionScientific = Department::where('department_name', 'Отдел комплектования и научной обработки фондов')->first();
        $educationalFictionLiterature = Department::where('department_name', 'Отдел обслуживания учебной и художественной литературой')->first();
        $general = Department::where('department_name', 'Общие')->first();

        $informationBibliographic = Sector::create(array(
            'sector_name' => 'Сектор информационно-библиографической и наукометрической работы',
            'department_id' => $scientificMethodological->id,
        ));

        $bookSupply = Sector::create(array(
            'sector_name' => 'Сектор книгообеспеченности',
            'department_id' => $acquisitionScientific->id,
        ));

        $recruitment = Sector::create(array(
            'sector_name' => 'Сектор комплектования',
            'department_id' => $acquisitionScientific->id,
        ));

        $fundsAccounting = Sector::create(array(
            'sector_name' => 'Сектор учета фондов',
            'department_id' => $acquisitionScientific->id,
        ));

        $scientificProcessing = Sector::create(array(
            'sector_name' => 'Сектор научной обработки фондов',
            'department_id' => $acquisitionScientific->id,
        ));

        $rareValuable = Sector::create(array(
            'sector_name' => 'Cектор редких и ценных изданий',
            'department_id' => $educationalFictionLiterature->id,
        ));

        $reRegisterReader = Sector::create(array(
            'sector_name' => 'Cектор регистрации читателей',
            'department_id' => $general->id,
        ));
    }
}
