<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $measurements = [
            [
                'measurement_name' => 'Без измерения',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 дневник',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 отчет',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 совещание',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 экскурсия',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 консультация',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 сообщение',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 план',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 документ',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 заявка',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 запись',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 название',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 список',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 техзадание',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 письмо',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 договор',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 посещение',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 форма',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 справка',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 соглашение',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 пачка',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 экз.',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 штрих-код',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 метка',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 лист',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 акт',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 номер',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 посылка',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 карточка',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 партия',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 описание',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 формуляр',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 карм.',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 ведомость',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 курс',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 специальность',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 дисциплина',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 связка',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 читатель',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 книга',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 требование',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 страница',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 полка',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 талон',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 файл',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 обзор',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 занятие',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 указатель',
                'measurement_description' => null,
            ],
            [
                'measurement_name' => '1 издание',
                'measurement_description' => null,
            ],
        ];

        DB::table('measurements')->insert($measurements);
    }
}
