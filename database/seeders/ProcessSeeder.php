<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Отделы
        $departments = [
            'Общие',
            'Научно-методический отдел',
            'Отдел комплектования и научной обработки фондов',
            'Информационно-библиографический отдел',
            'Отдел основного книгохранения',
            'Отдел национальной и краеведческой литературы',
            'Отдел учета публикационной статистики',
            'Отдел обслуживания научной литературой',
            'Отдел обслуживания учебной и художественной литературой',
            'Дирекция',
            'Сектор информационно-библиографической и наукометрической работы',
            'Сектор книгообеспеченности',
            'Сектор комплектования',
            'Сектор учета фондов',
            'Сектор научной обработки фондов',
            'Cектор редких и ценных изданий',
            'Cектор регистрации читателей'
        ];

        // Проверка существования отделов и получение их ID
        $departmentIds = [];
        foreach ($departments as $departmentName) {
            $department = Department::where('department_name', $departmentName)->first();
            if (!$department) {
                throw new \Exception("Отдел с именем '$departmentName' не найден.");
            }
            $departmentIds[$departmentName] = $department->department_id;
        }

        $processes = [
            [
                'process_name' => 'Подготовка рабочего места',
                'is_daily' => true,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 1,
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Заполнение личного дневника',
                'is_daily' => true,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 2, // 1 дневник
                'process_duration' => 0.17,
            ],
            [
                'process_name' => 'Заполнение дневника отдела',
                'is_daily' => true,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 2, // 1 дневник
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Научно-методическая работа',
                'is_daily' => true,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 1,
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Повышение квалификации',
                'is_daily' => false,
                'require_description' => true,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 1,
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Составление отчета за месяц',
                'is_daily' => false,
                'require_description' => true,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 3, // 1 отчет
                'process_duration' => 25,
            ],
            [
                'process_name' => 'Методическое объединение',
                'is_daily' => true,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 1,
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Планерное совещание',
                'is_daily' => true,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 4, // 1 совещание
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Организация и проведение экскурсии',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Научно-методический отдел'], // Научно-методический отдел
                'measurement_id' => 5, // 1 экскурсия
                'process_duration' => 1.4,
            ],
            [
                'process_name' => 'Консультации сотрудников устная',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Научно-методический отдел'], // Научно-методический отдел
                'measurement_id' => 6, // 1 консультация
                'process_duration' => 0.066,
            ],
            [
                'process_name' => 'Реклама биб-ки. Сообщение на сайт',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Научно-методический отдел'], // Научно-методический отдел
                'measurement_id' => 7, // 1 сообщение
                'process_duration' => 4,
            ],
            [
                'process_name' => 'Оформить план комплектования в форме таблиц по факультетам и кафедрам',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 8, // 1 план
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Создание информационных «досье» на каждый институт/ факультет/ кафедру',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 9, // 1 док-т
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Принять заявку на приобретение изданий от преподавателей.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 10, // 1 заявка
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Анализ заявок. Установить тему и вид документа, подлежащего отбору.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 10, // 1 заявка
                'process_duration' => 0.02,
            ],
            [
                'process_name' => 'Проверить в ЭК на предмет наличия данного издания в фонде библиотеки.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'поиск изданий в различных ЭБС',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Просмотр прайс-листов издательств.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.06,
            ],
            [
                'process_name' => 'Поиск в сети ИНТЕРНЕТ на рынке книгопечатной продукции сведений об издании',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.06,
            ],
            [
                'process_name' => 'Работа в АРМ «Комплектатор», БД «Заказ». Занесение дезидиратов',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Оформление заказа в табличной форме.Набор списка заказываемых книг',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 13, // 1 список
                'process_duration' => 0.02,
            ],
            [
                'process_name' => 'Заключение договоров.Подготовка материалов для проведения конкурсных процедур:составление(тех.задания)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 14, // 1 техзадание
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Составить лист согласования с деканами, на приобретение изданий',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Переписка поставщиками',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 15, // 1 письмо
                'process_duration' => 0.06,
            ],
            [
                'process_name' => 'Работа с договорами.Заключение/экспертиза)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 16, // 1 договор
                'process_duration' => 0.25,
            ],
            [
                'process_name' => 'Согласование Договоров и конкурсной документации с ЮУ+ПФУ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 17, // 1 посещение
                'process_duration' => 0.33,
            ],
            [
                'process_name' => 'Вывод форм электронной КСУ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 18, // 1 форма
                'process_duration' => 0.16,
            ],
            [
                'process_name' => 'Отметка о выполнении заказа на заявке.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 10, // 1 заявка
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Сверить контрольный экз. издания с таблицей заказа:',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Информирование о новых поступлениях. Составление списка поступивших изданий. Отправка списка по интитутам/ факультетам/ кафедрам',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Подготовка сообщений на сайт и джаббер.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 7, // 1 сообщение
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Регистрация трудов преподавателей для рейтинга БГУ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Консультации и справки',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 19, // 1 справка
                'process_duration' => 0.16,
            ],
            [
                'process_name' => 'Получить электронный файл издания из типографии',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 17, // 1 посещение
                'process_duration' => 66,
            ],
            [
                'process_name' => 'Работа с Электронной библиотекой НБ БГУ. Создание карточки издания в ЭБ. Занесение метаданных',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.15,
            ],
            [
                'process_name' => 'Получение прав доступа к платным/бесплатным/тестовым УЭР.',
                'is_daily' => false,
                'require_description' => true,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 20, // 1 соглашение
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Распаковка пачек по сопроводительным / без сопроводительных документов',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 21, // 1 пачка
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Подбор документов по авторам или заглавиям',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 9, // 1 док-т
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Сортировка изданий по типу и виду издания',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 22, // экз.
                'process_duration' => 0.005,
            ],
            [
                'process_name' => 'Прием новых документов из типографии',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 17, // 1 посещение
                'process_duration' => 0.66,
            ],
            [
                'process_name' => 'Сверка на дублетность поступивших документов с ЭК.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Проставить штемпель на тит.листе/17-й стр.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 9, // 1 док-т
                'process_duration' => 0.005,
            ],
            [
                'process_name' => 'Сверка на дублетность поступивших документов с ЭК.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Проставить инвентарный номер на документе.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 23, // 1 штрихкод
                'process_duration' => 0.003,
            ],
            [
                'process_name' => 'Выведение штрихкода и наклейка защитной пленки',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 24, // 1 метка
                'process_duration' => 0.005,
            ],
            [
                'process_name' => 'Наклейка и считывание RFID – метки',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 25, // 1 лист
                'process_duration' => 0.25,
            ],
            [
                'process_name' => 'Нарезка защитной пленки на штрих код',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'распределение изданий по месту хранения',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.11,
            ],
            [
                'process_name' => 'Написать карточку «В дар» на дарителя.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 22, // экз.
                'process_duration' => 0.16,
            ],
            [
                'process_name' => 'индивид. учет документа в тетради.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.33,
            ],
            [
                'process_name' => 'Внесение в ЭК элементов БО',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.16,
            ],
            [
                'process_name' => 'Приписка к БЗ в ЭК.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.025,
            ],
            [
                'process_name' => 'Редакция БЗ в ЭК',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Прием изданий от курьера по сопр. Материалам',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 9, // 1 док-т
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Сверка поступивших изданий с ведомостью',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Занесение данных в БД Комплектатор',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Распределение изданий по месту хранения',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 22, // 1 экз.
                'process_duration' => 0.007,
            ],
            [
                'process_name' => 'Оформление акта на исключение изданий, утерянных из фонда',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 26, // 1 акт
                'process_duration' => 0.16,
            ],
            [
                'process_name' => 'Прием актов на исключение от подразделений библиотеки',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 26, // 1 акт
                'process_duration' => 0.16,
            ],
            [
                'process_name' => 'Выявление недочетов БО по Актам списания и перестановке в учетных каталогах и документах',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.117,
            ],
            [
                'process_name' => 'Консультация по акту',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 26, // 1 акт
                'process_duration' => 0.25,
            ],
            [
                'process_name' => 'Распределение и запись поступлений в КСУ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 25, // 1 лист
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'постраничнное сумирование данных в КСУ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.055,
            ],
            [
                'process_name' => 'Составить Акт приема документов в НБ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 27, // 1 номер
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Копирование отчетных документов',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Оформление путевки на передачу партии документов в ОНОФ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.003,
            ],
            [
                'process_name' => 'Создание список в Word передаваемых изданий в парти',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.04,
            ],
            [
                'process_name' => 'Распечатка инвентарной книги',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Консультация читателя по замене утраченного издания',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 22, // 1 экз.
                'process_duration' => 0.055,
            ],
            [
                'process_name' => 'Просмотр издания, предлагаемого взамен утраченного',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 28, // 1 посылка
                'process_duration' => 0.5,
            ],
            [
                'process_name' => 'Заполнить «лист подтвержд. замены',
                'is_daily' => true,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 25, // 1 лист
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Составление списка утерянных изданий в WORD',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.055,
            ],
            [
                'process_name' => 'Поиск в инвентарных книгах описания исключаемого издания',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 27, // 1 номер
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Редакция в ЭК актов на списание. Поиск в ЭК БЗ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Внесение сведений об Актах в КСУ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.003,
            ],
            [
                'process_name' => 'Редактирование БЗ в БД (изменение сиглов, места хранения)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.04,
            ],
            [
                'process_name' => 'Редакция БЗ через «мастер списания"',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.55,
            ],
            [
                'process_name' => 'Составление списка отобранной литературы из ПФ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Подбор книг из ПФ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 22, // 1 экз.
                'process_duration' => 0.005,
            ],
            [
                'process_name' => 'Упаковка издания в посылку, написать адрес получателя',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 28, // 1 посылка
                'process_duration' => 0.5,
            ],
            [
                'process_name' => 'Отметка о выбытии многоэкземплярной литературы в картотеке учебников',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 29, // 1 карточка
                'process_duration' => 0.025,
            ],
            [
                'process_name' => 'Прием док-тов из сектора учета. Сверка с сопроводит док-том',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 30, // 1 партия
                'process_duration' => 0.18,
            ],
            [
                'process_name' => 'Регистрация сведений в Тетради учета получения изданий',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 9, // 1 док-т
                'process_duration' => 0.005,
            ],
            [
                'process_name' => 'Сверка изданий со служебным АК',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 29, // 1 карточка
                'process_duration' => 0.036,
            ],
            [
                'process_name' => 'Сверка док-тов на дублетность по служебному АК',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.018,
            ],
            [
                'process_name' => 'Приписка дублетов в каталог',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 22, // 1 экз.
                'process_duration' => 0.016,
            ],
            [
                'process_name' => 'Приписка дублетов в ЭК',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.055,
            ],
            [
                'process_name' => 'Ознакомиться с док-том. Установить тематику',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.017,
            ],
            [
                'process_name' => 'Систематизация изданий',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.09,
            ],
            [
                'process_name' => 'Систематизация изданий на иностр. языках',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.1,
            ],
            [
                'process_name' => 'Систематизация сложных изданий',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.25,
            ],
            [
                'process_name' => 'Определение авторского знака',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.012,
            ],
            [
                'process_name' => 'Предметизация издания',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.09,
            ],
            [
                'process_name' => 'Принятие предметизационного решения',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.286,
            ],
            [
                'process_name' => 'Составление новой рубрики для АПУ',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 29, // 1 карточка
                'process_duration' => 0.04,
            ],
            [
                'process_name' => 'Составление новой рубрики для СКК',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 29, // 1 карточка
                'process_duration' => 0.04,
            ],
            [
                'process_name' => 'Определение ключевых слов',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.18,
            ],
            [
                'process_name' => 'Форматная шифровка изданий',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.008,
            ],
            [
                'process_name' => 'Формирование БЗ для ЭК1 описание',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.17,
            ],
            [
                'process_name' => 'Формироване БЗ на иностр. яз и краеведение',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.19,
            ],
            [
                'process_name' => 'Формирование БО (диссертации и авторефераты)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.33,
            ],
            [
                'process_name' => 'Формирование БЗ в ЭБ (диссертации и авторефераты)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.3,
            ],
            [
                'process_name' => 'Редактирование библ/гр записи в БД',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Редактирование записи БД "Электронные сетевые ресурсы"',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.2,
            ],
            [
                'process_name' => 'Методическое редактирование',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.1,
            ],
            [
                'process_name' => 'Редактирование классификационного индекса',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 29, // 1 карточка
                'process_duration' => 0.017,
            ],
            [
                'process_name' => 'Оформление карточки для тиражирования',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 29, // 1 карточка
                'process_duration' => 0.02,
            ],
            [
                'process_name' => 'Распределение каталожных карточек на новые поступления',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 29, // 1 карточка
                'process_duration' => 0.008,
            ],
            [
                'process_name' => 'Оформление кн. формуляра для тиражирования',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 32, // 1 формуляр
                'process_duration' => 0.017,
            ],
            [
                'process_name' => 'Написание шифра на издании',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 22, // 1 экз.
                'process_duration' => 0.005,
            ],
            [
                'process_name' => 'Наклейка крмашка',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 34, // 1 карм.
                'process_duration' => 0.008,
            ],
            [
                'process_name' => 'Подбор карточек по алфавиту для служебного каталога',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 29, // 1 карточка
                'process_duration' => 0.013,
            ],
            [
                'process_name' => 'Расстановкка карточек в служебный каталог',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 29, // 1 карточка
                'process_duration' => 0.007,
            ],
            [
                'process_name' => 'Заполнение передаточной ведомости',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 35, // 1 ведомость
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Копирование и распечатка файла WORD необходимого семестра учебного плана из БД «Университет» во вкладке «Учебные планы».',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 25, // 1 лист
                'process_duration' => 0.04,
            ],
            [
                'process_name' => 'Уточнение обучающегося контингента по данной специальности на данном курсе в БД «Университет» во вкладке «Студенты».',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 35, // 1 курс
                'process_duration' => 0.016,
            ],
            [
                'process_name' => 'Формирование справочника по специальностям.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 36, // 1 специальность
                'process_duration' => 0.02,
            ],
            [
                'process_name' => 'Добавление дисциплины в кафедру в АРМе "Книгообеспеченность',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 37, // 1 дисциплина
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Поиск и перенос внесенной дисциплины с кафедры в нужный семестр определенной специальности.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 37, // 1 дисциплина
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Добавление в запись дисциплины данных для нового контингента студентов.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 36, // 1 специальность
                'process_duration' => 0.02,
            ],
            [
                'process_name' => 'Формирование новых факультетов, семестров, кафедр.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 38, // 1 связка
                'process_duration' => 0.02,
            ],
            [
                'process_name' => 'Удаление специальностей (контингента).',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 38, // 1 связка
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Поиск книг в БД «Книги», «Краеведение», Труды преподавателей',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Поиск изданий в различных ЭБС',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Поиск БО книг в АРМе «Комплектатор», в режиме «Заказ» для уточнения данных: специальность, дисциплина, семестр, курс.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'данных к БЗ нет в ЭК, то уточнение данных ведется в печатном варианте самой заявки на приобретение изданий',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 10, // 1 заявка
                'process_duration' => 0.025,
            ],
            [
                'process_name' => 'Удаление в АРМе «Книгообеспеченность» неправильных данных (связка): книга, специальность, дисциплина.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 38, // 1 связка
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Удаление в АРМе "Каталогизатор" в 693 поле: ВУЗ: Текущие значения ККО',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Привязка БО книги к специальности/дисциплине: выбрать дисциплину, специальность, вид литературы.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Формирование итоговых табличных форм по книгообеспеченности',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 18, // 1 форма
                'process_duration' => 6,
            ],
            [
                'process_name' => 'Поиск книг в ЭК для внесения данных в таблицу. Создание раздела, копирование БО, форматирование',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Подсчет количества экземпляров, названий, коэффициента, обновляемости литературы по: дисциплине, циклу дисциплин, специальности/направлению',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 37, // 1 дисциплина
                'process_duration' => 0.5,
            ],
            [
                'process_name' => 'Принять заявку для включения в тематический план изданий РИО БГУ от автора',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 10, // 1 заявка
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Отверить заявку по формальным признакам по всем графам.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 10, // 1 заявка
                'process_duration' => 0.17,
            ],
            [
                'process_name' => 'Поиск заявленного издания в ЭК на предмет наличия данного издания в фонде библиотеки.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Проверка в ИС "Университет": дисциплина к заявленному изданию, курс, семестр, цикл',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 36, // 1 специальность
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Подсчет количества студентов, одновременно изучающих дисциплину',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 35, // 1 курс
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Подсчет количества экземпляров, необходимых в фонд библиотеки головного вуза и по необходимости в филиалы',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Подписание и копирование проверенной заявки на темплан',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 10, // 1 заявка
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Консультации преподавателей по заполнению заявки на тематический план изданий РИО БГУ. По заполнению различных форм (мониторинг,самообследование, аккредитация, лицензирование',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 6, // 1 консультация
                'process_duration' => 0.06,
            ],
            [
                'process_name' => 'Уточнение дисциплин в "Учебном плане",проверка РПД',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 37, // 1 дисциплина
                'process_duration' => 0.1,
            ],
            [
                'process_name' => 'Корректировка данных в модуле "Учебный план"(замена названия кафедры, замена названия дисциплины и т.д.)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел комплектования и научной обработки фондов'], // Отдел комплектования и научной обработки фондов
                'measurement_id' => 11, // 1 запись
                'process_duration' => 0.02,
            ],
            [
                'process_name' => 'Запись читателя в биб-ку',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 39, // 1 чит.
                'process_duration' => 0.075,
            ],
            [
                'process_name' => 'Перерегистрация читателей',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 39, // 1 чит.
                'process_duration' => 0.016,
            ],
            [
                'process_name' => 'Прием литературы от читателей',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Продление срока пользования',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Выдача произведений печати',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.066,
            ],
            [
                'process_name' => 'Консультация, рекомендательная беседа',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 6, // 1 консультация
                'process_duration' => 0.066,
            ],
            [
                'process_name' => 'Заполнение листа замены',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 25, // 1 лист
                'process_duration' => 0.08,
            ],
            [
                'process_name' => 'Подписание обходного листа',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 25, // 1 лист
                'process_duration' => 0.025,
            ],
            [
                'process_name' => 'Выполнение адресно-библ. справок',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 19, // 1 справка
                'process_duration' => 0.023,
            ],
            [
                'process_name' => 'Выполнение тематической справки',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 19, // 1 справка
                'process_duration' => 0.021,
            ],
            [
                'process_name' => 'Выполнение уточняющей библ. справки',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 19, // 1 справка
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Выполнение фактографической библ. справки',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 19, // 1 справка
                'process_duration' => 0.25,
            ],
            [
                'process_name' => 'Работа с отказами',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 41, // 1 требование
                'process_duration' => 0.03,
            ],
            [
                'process_name' => 'Работа с читательской задолженностью (составление списков)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 39, // 1 читатель
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Подбор лит-ры для выставки (монтаж, демонтаж выставки)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 3.5,
            ],
            [
                'process_name' => 'Расстановка фонда',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.02,
            ],
            [
                'process_name' => 'Обеспыливание фонда',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.18,
            ],
            [
                'process_name' => 'Передвижка фонда',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.078,
            ],
            [
                'process_name' => 'Реставрация фонда (ремонт книг в страницах)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 42, // 1 страница
                'process_duration' => 0.66,
            ],
            [
                'process_name' => 'Наклеить на документ кармашек',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Наклеить на документ ярлык',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Заполнить книжн.формуляр',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 32, // 1 формуляр
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Написать шифр на док.',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Написать шифр на ярлык',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.01,
            ],
            [
                'process_name' => 'Оформление фонда разделителями',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 43, // 1 полка
                'process_duration' => 0.07,
            ],
            [
                'process_name' => 'Проверка расстановки фонда',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 1,
                'process_duration' => 0.5,
            ],
            [
                'process_name' => 'RF-метка на фонд',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 22, // 1 книга
                'process_duration' => 0.033,
            ],
            [
                'process_name' => 'Составление акта приема передачи фонда',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 12, // 1 название
                'process_duration' => 0.015,
            ],
            [
                'process_name' => 'Написание индикаторного талона',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 44, // 1 талон
                'process_duration' => 0.016,
            ],
            [
                'process_name' => 'Разбор индикат.талонов по алфавиту',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 44, // 1 талон
                'process_duration' => 0.006,
            ],
            [
                'process_name' => 'Разбор индикат.талонов по номерам',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 44, // 1 талон
                'process_duration' => 0.006,
            ],
            [
                'process_name' => 'Расст. индикат.талонов по алфавиту',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 44, // 1 талон
                'process_duration' => 0.006,
            ],
            [
                'process_name' => 'Расст. индикат.талонов по номерам',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 44, // 1 талон
                'process_duration' => 0.006,
            ],
            [
                'process_name' => 'Редактир-е( после конвертирования и приписки дублетов)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.1,
            ],
            [
                'process_name' => 'Копирование источников',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 42, // 1 страница
                'process_duration' => 0.008,
            ],
            [
                'process_name' => 'Распечатка источников',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 42, // 1 страница
                'process_duration' => 0.006,
            ],
            [
                'process_name' => 'Приклепление файлов БД Труды',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Информационно-библиографический отдел'], // Информационно-библиографический отдел
                'measurement_id' => 45, // 1 файл
                'process_duration' => 0.17,
            ],
            [
                'process_name' => 'Занесение библ. описания в Электронную библиотеку',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.25,
            ],
            [
                'process_name' => 'Редактироваие библиографических списков',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Информационно-библиографический отдел'], // Информационно-библиографический отдел
                'measurement_id' => 31, // 1 описание
                'process_duration' => 0.05,
            ],
            [
                'process_name' => 'Библиографический обзор (подготовка, проведение)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // общие
                'measurement_id' => 46, // 1 обзор
                'process_duration' => 7.4,
            ],
            [
                'process_name' => 'Индексирование документов (УДК, ББК)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Информационно-библиографический отдел'], // Информационно-библиографический отдел
                'measurement_id' => 9, // 1 документ
                'process_duration' => 0.17,
            ],
            [
                'process_name' => 'Обучение пользоателей (кол-во проведенных занятий)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Информационно-библиографический отдел'], // Информационно-библиографический отдел
                'measurement_id' => 47, // 1 занятие
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Библиографический указатель (подготовка)',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Информационно-библиографический отдел'], // Информационно-библиографический отдел
                'measurement_id' => 48, // 1 указатель
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Работа с виртуальной структурой университета в НЭБ \"Elibrary\"',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел учета публикационной статистики'], // Отдел учета публикационной статистики
                'measurement_id' => 31, // 1 описание
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Перевод файла в html-формат, разбивка файла',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Отдел учета публикационной статистики'], // Отдел учета публикационной статистики
                'measurement_id' => 49, // 1 издание
                'process_duration' => 60,
            ],
            [
                'process_name' => 'Регистрация в ЭБС',
                'is_daily' => false,
                'require_description' => false,
                'department_id' => $departmentIds['Общие'], // Общие
                'measurement_id' => 39, // 1 читатель
                'process_duration' => 60,
            ],
        ];

        DB::beginTransaction();
        try {
            DB::table('processes')->insert($processes);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e; // Обработка ошибки
        }
    }
}
