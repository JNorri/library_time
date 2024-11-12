<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Sector;
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
        $general = Department::where('department_name', 'Общие')->first();
        $scientificMethodological = Department::where('department_name', 'Научно-методический отдел')->first();
        $acquisitionScientific = Department::where('department_name', 'Отдел комплектования и научной обработки фондов')->first();
        $informationBibliographic = Department::where('department_name', 'Информационно-библиографический отдел')->first();
        // $mainBookStorage = Department::where('department_name', 'Отдел основного книгохранения')->first();
        // $nationalLocalHistory = Department::where('department_name', 'Отдел национальной и краеведческой литературы')->first();
        $publicationStatistics = Department::where('department_name', 'Отдел учета публикационной статистики')->first();
        // $scientificLiterature = Department::where('department_name', 'Отдел обслуживания научной литературой')->first();
        // $directorate = Department::where('department_name', 'Дирекция')->first();
        // $educationalFictionLiterature = Department::where('department_name', 'Отдел обслуживания учебной и художественной литературой')->first();

        // Секторы
        $informationBibliographic = Sector::where('sector_name', 'Сектор информационно-библиографической и наукометрической работы')->first();
        $bookSupply = Sector::where('sector_name', 'Сектор книгообеспеченности')->first();
        // $recruitment = Sector::where('sector_name', 'Сектор комплектования')->first();
        // $fundsAccounting = Sector::where('sector_name', 'Сектор учета фондов')->first();
        $scientificProcessing = Sector::where('sector_name', 'Сектор научной обработки фондов')->first();
        // $rareValuable = Sector::where('sector_name', 'Cектор редких и ценных изданий')->first();
        $reRegisterReader = Sector::where('sector_name', 'Cектор регистрации читателей')->first();

        $processes = [
            [
                'process_name' => 'Подготовка рабочего места',
                'measurement_id' => null,
                'time_in_hours' => 0.08,
                'process_is_daily' => true,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Заполнение личного дневника',
                'measurement_id' => 2, // 1 дневник
                'time_in_hours' => 0.17,
                'process_is_daily' => true,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Заполнение дневника отдела',
                'measurement_id' => 2, // 1 дневник
                'time_in_hours' => null,
                'process_is_daily' => true,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Научно-методическая работа',
                'measurement_id' => null,
                'time_in_hours' => null,
                'process_is_daily' => true,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Повышение квалификации',
                'measurement_id' => null,
                'time_in_hours' => 0,
                'process_is_daily' => false,
                'requires_description' => true,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Составление отчета за месяц',
                'measurement_id' => 3, // 1 отчет
                'time_in_hours' => 25,
                'process_is_daily' => false,
                'requires_description' => true,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Методическое объединение',
                'measurement_id' => null,
                'time_in_hours' => null,
                'process_is_daily' => true,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Планерное совещание',
                'measurement_id' => 4, // 1 совещание
                'time_in_hours' => null,
                'process_is_daily' => true,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Организация и проведение экскурсии',
                'measurement_id' => 5, // 1 экскурсия
                'time_in_hours' => 1.4,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $scientificMethodological->id, // Научно-методический отдел
                'sector_id' => null,
            ],
            [
                'process_name' => 'Консультации сотрудников устная',
                'measurement_id' => 6, // 1 консультация
                'time_in_hours' => 0.066,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $scientificMethodological->id, // Научно-методический отдел
                'sector_id' => null,
            ],
            [
                'process_name' => 'Реклама биб-ки. Сообщение на сайт',
                'measurement_id' => 7, // 1 сообщение
                'time_in_hours' => 4,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $scientificMethodological->id, // Научно-методический отдел
                'sector_id' => null,
            ],
            [
                'process_name' => 'Оформить план комплектования в форме таблиц по факультетам и кафедрам',
                'measurement_id' => 8, // 1 план
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Создание информационных «досье» на каждый институт/ факультет/ кафедру',
                'measurement_id' => 9, // 1 док-т
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Принять заявку на приобретение изданий от преподавателей.',
                'measurement_id' => 10, // 1 заявка
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Анализ заявок. Установить тему и вид документа, подлежащего отбору.',
                'measurement_id' => 10, // 1 заявка
                'time_in_hours' => 0.02,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Проверить в ЭК на предмет наличия данного издания в фонде библиотеки.',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'поиск изданий в различных ЭБС',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Просмотр прайс-листов издательств.',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.06,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Поиск в сети ИНТЕРНЕТ на рынке книгопечатной продукции сведений об издании',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.06,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Работа в АРМ «Комплектатор», БД «Заказ». Занесение дезидиратов',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Оформление заказа в табличной форме.Набор списка заказываемых книг',
                'measurement_id' => 13, // 1 список
                'time_in_hours' => 0.02,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Заключение договоров.Подготовка материалов для проведения конкурсных процедур:составление(тех.задания)',
                'measurement_id' => 14, // 1 техзадание
                'time_in_hours' => null,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Составить лист согласования с деканами, на приобретение изданий',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Переписка поставщиками',
                'measurement_id' => 15, // 1 письмо
                'time_in_hours' => 0.06,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Работа с договорами.Заключение/экспертиза)',
                'measurement_id' => 16, // 1 договор
                'time_in_hours' => 0.25,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Согласование Договоров и конкурсной документации с ЮУ+ПФУ',
                'measurement_id' => 17, // 1 посещение
                'time_in_hours' => 0.33,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Вывод форм электронной КСУ',
                'measurement_id' => 18, // 1 форма
                'time_in_hours' => 0.16,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Отметка о выполнении заказа на заявке.',
                'measurement_id' => 10, // 1 заявка
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Сверить контрольный экз. издания с таблицей заказа:',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Информирование о новых поступлениях. Составление списка поступивших изданий. Отправка списка по интитутам/ факультетам/ кафедрам',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Подготовка сообщений на сайт и джаббер.',
                'measurement_id' => 7, // 1 сообщение
                'time_in_hours' => null,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Регистрация трудов преподавателей для рейтинга БГУ',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Консультации и справки',
                'measurement_id' => 19, // 1 справка
                'time_in_hours' => 0.16,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Получить электронный файл издания из типографии',
                'measurement_id' => 17, // 1 посещение
                'time_in_hours' => 66,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Работа с Электронной библиотекой НБ БГУ. Создание карточки издания в ЭБ. Занесение метаданных',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.15,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Получение прав доступа к платным/бесплатным/тестовым УЭР.',
                'measurement_id' => 20, // 1 соглашение
                'time_in_hours' => null,
                'process_is_daily' => false,
                'requires_description' => true,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Распаковка пачек по сопроводительным / без сопроводительных документов',
                'measurement_id' => 21, // 1 пачка
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Подбор документов по авторам или заглавиям',
                'measurement_id' => 9, // 1 док-т
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Сортировка изданий по типу и виду издания',
                'measurement_id' => 22, // экз.
                'time_in_hours' => 0.005,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Прием новых документов из типографии',
                'measurement_id' => 17, // 1 посещение
                'time_in_hours' => 0.66,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Сверка на дублетность поступивших документов с ЭК.',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Проставить штемпель на тит.листе/17-й стр.',
                'measurement_id' => 9, // 1 док-т
                'time_in_hours' => 0.005,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Сверка на дублетность поступивших документов с ЭК.',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Проставить инвентарный номер на документе.',
                'measurement_id' => 23, // 1 штрихкод
                'time_in_hours' => 0.003,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Выведение штрихкода и наклейка защитной пленки',
                'measurement_id' => 24, // 1 метка
                'time_in_hours' => 0.005,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Наклейка и считывание RFID – метки',
                'measurement_id' => 25, // 1 лист
                'time_in_hours' => 0.25,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Нарезка защитной пленки на штрих код',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'распределение изданий по месту хранения',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.11,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Написать карточку «В дар» на дарителя.',
                'measurement_id' => 22, // экз.
                'time_in_hours' => 0.16,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'индивид. учет документа в тетради.',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.33,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Внесение в ЭК элементов БО',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.16,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Приписка к БЗ в ЭК.',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.025,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Редакция БЗ в ЭК',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Прием изданий от курьера по сопр. Материалам',
                'measurement_id' => 9, // 1 док-т
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Сверка поступивших изданий с ведомостью',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Занесение данных в БД Комплектатор',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Распределение изданий по месту хранения',
                'measurement_id' => 22, // 1 экз.
                'time_in_hours' => 0.007,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Оформление акта на исключение изданий, утерянных из фонда',
                'measurement_id' => 26, // 1 акт
                'time_in_hours' => 0.16,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Прием актов на исключение от подразделений библиотеки',
                'measurement_id' => 26, // 1 акт
                'time_in_hours' => 0.16,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Выявление недочетов БО по Актам списания и перестановке в учетных каталогах и документах',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.117,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Консультация по акту',
                'measurement_id' => 26, // 1 акт
                'time_in_hours' => 0.25,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Распределение и запись поступлений в КСУ',
                'measurement_id' => 25, // 1 лист
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'постраничнное сумирование данных в КСУ',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.055,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Составить Акт приема документов в НБ',
                'measurement_id' => 27, // 1 номер
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Копирование отчетных документов',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Оформление путевки на передачу партии документов в ОНОФ',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.003,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Создание список в Word передаваемых изданий в парти',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.04,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Распечатка инвентарной книги',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Консультация читателя по замене утраченного издания',
                'measurement_id' => 22, // 1 экз.
                'time_in_hours' => 0.055,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Просмотр издания, предлагаемого взамен утраченного',
                'measurement_id' => 28, // 1 посылка
                'time_in_hours' => 0.5,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Заполнить «лист подтвержд. замены',
                'measurement_id' => 29, // 1 лист
                'time_in_hours' => 0.05,
                'process_is_daily' => true,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Составление списка утерянных изданий в WORD',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.055,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Поиск в инвентарных книгах описания исключаемого издания',
                'measurement_id' => 27, // 1 номер
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Редакция в ЭК актов на списание. Поиск в ЭК БЗ',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Внесение сведений об Актах в КСУ',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.003,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Редактирование БЗ в БД (изменение сиглов, места хранения)',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.04,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Редакция БЗ через «мастер списания"',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.55,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Составление списка отобранной литературы из ПФ',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Подбор книг из ПФ',
                'measurement_id' => 22, // 1 экз.
                'time_in_hours' => 0.005,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Упаковка издания в посылку, написать адрес получателя',
                'measurement_id' => 28, // 1 посылка
                'time_in_hours' => 0.5,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Отметка о выбытии многоэкземплярной литературы в картотеке учебников',
                'measurement_id' => 30, // 1 карточка
                'time_in_hours' => 0.025,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => null,
            ],
            [
                'process_name' => 'Прием док-тов из сектора учета. Сверка с сопроводит док-том',
                'measurement_id' => 31, // 1 партия
                'time_in_hours' => 0.18,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Регистрация сведений в Тетради учета получения изданий',
                'measurement_id' => 9, // 1 док-т
                'time_in_hours' => 0.005,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Сверка изданий со служебным АК',
                'measurement_id' => 30, // 1 карточка
                'time_in_hours' => 0.036,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Сверка док-тов на дублетность по служебному АК',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.018,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Приписка дублетов в каталог',
                'measurement_id' => 22, // 1 экз.
                'time_in_hours' => 0.016,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Приписка дублетов в ЭК',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.055,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Ознакомиться с док-том. Установить тематику',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.017,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Систематизация изданий',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.09,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Систематизация изданий на иностр. языках',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.1,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Систематизация сложных изданий',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.25,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Определение авторского знака',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.012,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Предметизация издания',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.09,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Принятие предметизационного решения',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.286,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Составление новой рубрики для АПУ',
                'measurement_id' => 30, // 1 карточка
                'time_in_hours' => 0.04,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Составление новой рубрики для СКК',
                'measurement_id' => 30, // 1 карточка
                'time_in_hours' => 0.04,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Определение ключевых слов',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.18,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Форматная шифровка изданий',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.008,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Формирование БЗ для ЭК1 описание',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.17,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Формироване БЗ на иностр. яз и краеведение',
                'measurement_id' => 32, // 1 описане
                'time_in_hours' => 0.19,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Формирование БО (диссертации и авторефераты)',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.33,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Формирование БЗ в ЭБ (диссертации и авторефераты)',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.3,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Редактирование библ/гр записи в БД',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Редактирование записи БД "Электронные сетевые ресурсы"',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.2,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Методическое редактирование',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.1,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Редактирование классификационного индекса',
                'measurement_id' => 30, // 1 карточка
                'time_in_hours' => 0.017,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Оформление карточки для тиражирования',
                'measurement_id' => 30, // 1 карточка
                'time_in_hours' => 0.02,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Распределение каталожных карточек на новые поступления',
                'measurement_id' => 30, // 1 карточка
                'time_in_hours' => 0.008,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Оформление кн. формуляра для тиражирования',
                'measurement_id' => 33, // 1 формуляр
                'time_in_hours' => 0.017,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Написание шифра на издании',
                'measurement_id' => 22, // 1 экз.
                'time_in_hours' => 0.005,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Наклейка крмашка',
                'measurement_id' => 34, // 1 карм.
                'time_in_hours' => 0.008,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Подбор карточек по алфавиту для служебного каталога',
                'measurement_id' => 30, // 1 карточка
                'time_in_hours' => 0.013,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Расстановкка карточек в служебный каталог',
                'measurement_id' => 30, // 1 карточка
                'time_in_hours' => 0.007,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Заполнение передаточной ведомости',
                'measurement_id' => 35, // 1 ведомость
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $scientificProcessing->id, // сектор научной обработки фондов
            ],
            [
                'process_name' => 'Копирование и распечатка файла WORD необходимого семестра учебного плана из БД «Университет» во вкладке «Учебные планы».',
                'measurement_id' => 25, // 1 лист
                'time_in_hours' => 0.04,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Уточнение обучающегося контингента по данной специальности на данном курсе в БД «Университет» во вкладке «Студенты».',
                'measurement_id' => 36, // 1 курс
                'time_in_hours' => 0.016,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Формирование справочника по специальностям.',
                'measurement_id' => 37, // 1 специальность
                'time_in_hours' => 0.02,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Добавление дисциплины в кафедру в АРМе "Книгообеспеченность',
                'measurement_id' => 38, // 1 дисциплина
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Поиск и перенос внесенной дисциплины с кафедры в нужный семестр определенной специальности.',
                'measurement_id' => 38, // 1 дисциплина
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Добавление в запись дисциплины данных для нового контингента студентов.',
                'measurement_id' => 37, // 1 специальность
                'time_in_hours' => 0.02,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Формирование новых факультетов, семестров, кафедр.',
                'measurement_id' => 39, // 1 связка
                'time_in_hours' => 0.02,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Удаление специальностей (контингента).',
                'measurement_id' => 39, // 1 связка
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Поиск книг в БД «Книги», «Краеведение», Труды преподавателей',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Поиск изданий в различных ЭБС',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Поиск БО книг в АРМе «Комплектатор», в режиме «Заказ» для уточнения данных: специальность, дисциплина, семестр, курс.',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'данных к БЗ нет в ЭК, то уточнение данных ведется в печатном варианте самой заявки на приобретение изданий',
                'measurement_id' => 10, // 1 заявка
                'time_in_hours' => 0.025,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Удаление в АРМе «Книгообеспеченность» неправильных данных (связка): книга, специальность, дисциплина.',
                'measurement_id' => 39, // 1 связка
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Удаление в АРМе "Каталогизатор" в 693 поле: ВУЗ: Текущие значения ККО',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Привязка БО книги к специальности/дисциплине: выбрать дисциплину, специальность, вид литературы.',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Формирование итоговых табличных форм по книгообеспеченности',
                'measurement_id' => 18, // 1 форма
                'time_in_hours' => 6,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Поиск книг в ЭК для внесения данных в таблицу. Создание раздела, копирование БО, форматирование',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Подсчет количества экземпляров, названий, коэффициента, обновляемости литературы по: дисциплине, циклу дисциплин, специальности/направлению',
                'measurement_id' => 38, // 1 дисциплина
                'time_in_hours' => 0.5,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Принять заявку для включения в тематический план изданий РИО БГУ от автора',
                'measurement_id' => 10, // 1 заявка
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Отверить заявку по формальным признакам по всем графам.',
                'measurement_id' => 10, // 1 заявка
                'time_in_hours' => 0.17,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Поиск заявленного издания в ЭК на предмет наличия данного издания в фонде библиотеки.',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Проверка в ИС "Университет": дисциплина к заявленному изданию, курс, семестр, цикл',
                'measurement_id' => 37, // 1 специальность
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Подсчет количества студентов, одновременно изучающих дисциплину',
                'measurement_id' => 36, // 1 курс
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Подсчет количества экземпляров, необходимых в фонд библиотеки головного вуза и по необходимости в филиалы',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Подписание и копирование проверенной заявки на темплан',
                'measurement_id' => 10, // 1 заявка
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Консультации преподавателей по заполнению заявки на тематический план изданий РИО БГУ. По заполнению различных форм (мониторинг,самообследование, аккредитация, лицензирование',
                'measurement_id' => 6, // 1 консультация
                'time_in_hours' => 0.06,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Уточнение дисциплин в "Учебном плане",проверка РПД',
                'measurement_id' => 38, // 1 дисциплина
                'time_in_hours' => 0.1,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Корректировка данных в модуле "Учебный план"(замена названия кафедры, замена названия дисциплины и т.д.)',
                'measurement_id' => 11, // 1 запись
                'time_in_hours' => 0.02,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $acquisitionScientific->id, // Отдел комплектования и научной обработки фондов
                'sector_id' => $bookSupply->id, // сектор книгообеспеченности
            ],
            [
                'process_name' => 'Запись читателя в биб-ку',
                'measurement_id' => 40, // 1 чит.
                'time_in_hours' => 0.075,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Перерегистрация читателей',
                'measurement_id' => 40, // 1 чит.
                'time_in_hours' => 0.016,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => $reRegisterReader->id, // сектор регистрации читателей
            ],
            [
                'process_name' => 'Прием литературы от читателей',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Продление срока пользования',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Выдача произведений печати',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.066,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Консультация, рекомендательная беседа',
                'measurement_id' => 6, // 1 консультация
                'time_in_hours' => 0.066,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Заполнение листа замены',
                'measurement_id' => 29, // 1 лист
                'time_in_hours' => 0.08,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Подписание обходного листа',
                'measurement_id' => 29, // 1 лист
                'time_in_hours' => 0.025,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Выполнение адресно-библ. справок',
                'measurement_id' => 19, // 1 справка
                'time_in_hours' => 0.023,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Выполнение тематической справки',
                'measurement_id' => 19, // 1 справка
                'time_in_hours' => 0.021,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Выполнение уточняющей библ. справки',
                'measurement_id' => 19, // 1 справка
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Выполнение фактографической библ. справки',
                'measurement_id' => 19, // 1 справка
                'time_in_hours' => 0.25,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Работа с отказами',
                'measurement_id' => 41, // 1 требование
                'time_in_hours' => 0.03,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Работа с читательской задолженностью (составление списков)',
                'measurement_id' => 40, // 1 читатель
                'time_in_hours' => null,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Подбор лит-ры для выставки (монтаж, демонтаж выставки)',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 3.5,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Расстановка фонда',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.02,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Обеспыливание фонда',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.18,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Передвижка фонда',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.078,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Реставрация фонда (ремонт книг в страницах)',
                'measurement_id' => 42, // 1 страница
                'time_in_hours' => 0.66,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Наклеить на документ кармашек',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Наклеить на документ ярлык',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Заполнить книжн.формуляр',
                'measurement_id' => 33, // 1 формуляр
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Написать шифр на док.',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Написать шифр на ярлык',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.01,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => $informationBibliographic->id, // сектор информационно-библиографической и наукометрической работы
            ],
            [
                'process_name' => 'Оформление фонда разделителями',
                'measurement_id' => 43, // 1 полка
                'time_in_hours' => 0.07,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Проверка расстановки фонда',
                'measurement_id' => null,
                'time_in_hours' => 0.5,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'RF-метка на фонд',
                'measurement_id' => 22, // 1 книга
                'time_in_hours' => 0.033,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Составление акта приема передачи фонда',
                'measurement_id' => 12, // 1 название
                'time_in_hours' => 0.015,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Написание индикаторного талона',
                'measurement_id' => 44, // 1 талон
                'time_in_hours' => 0.016,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Разбор индикат.талонов по алфавиту',
                'measurement_id' => 44, // 1 талон
                'time_in_hours' => 0.006,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Разбор индикат.талонов по номерам',
                'measurement_id' => 44, // 1 талон
                'time_in_hours' => 0.006,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Расст. индикат.талонов по алфавиту',
                'measurement_id' => 44, // 1 талон
                'time_in_hours' => 0.006,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Расст. индикат.талонов по номерам',
                'measurement_id' => 44, // 1 талон
                'time_in_hours' => 0.006,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Редактир-е( после конвертирования и приписки дублетов)',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.1,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Копирование источников',
                'measurement_id' => 42, // 1 страница
                'time_in_hours' => 0.008,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Распечатка источников',
                'measurement_id' => 42, // 1 страница
                'time_in_hours' => 0.006,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Приклепление файлов БД Труды',
                'measurement_id' => 45, // 1 файл
                'time_in_hours' => 0.17,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $informationBibliographic->id, // Информационно-библиографический отдел
                'sector_id' => null,
            ],
            [
                'process_name' => 'Занесение библ. описания в Электронную библиотеку',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.25,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Редактироваие библиографических списков',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => 0.05,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $informationBibliographic->id, // Информационно-библиографический отдел
                'sector_id' => null,
            ],
            [
                'process_name' => 'Библиографический обзор (подготовка, проведение)',
                'measurement_id' => 46, // 1 обзор
                'time_in_hours' => 7.4,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // общие
                'sector_id' => null,
            ],
            [
                'process_name' => 'Индексирование документов (УДК, ББК)',
                'measurement_id' => 47, // 1 документ
                'time_in_hours' => 0.17,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $informationBibliographic->id, // Информационно-библиографический отдел
                'sector_id' => null,
            ],
            [
                'process_name' => 'Обучение пользоателей (кол-во проведенных занятий)',
                'measurement_id' => 48, // 1 занятие
                'time_in_hours' => null,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $informationBibliographic->id, // Информационно-библиографический отдел
                'sector_id' => null,
            ],
            [
                'process_name' => 'Библиографический указатель (подготовка)',
                'measurement_id' => 49, // 1 указатель
                'time_in_hours' => null,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $informationBibliographic->id, // Информационно-библиографический отдел
                'sector_id' => null,
            ],
            [
                'process_name' => 'Работа с виртуальной структурой университета в НЭБ «Elibrary»',
                'measurement_id' => 32, // 1 описание
                'time_in_hours' => null,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $publicationStatistics->id, // Отдел публикационной статистики
                'sector_id' => null,
            ],
            [
                'process_name' => 'Перевод файла в html-формат, разбивка файла',
                'measurement_id' => 50, // 1 издание
                'time_in_hours' => null,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $publicationStatistics->id, // Отдел публикационной статистики
                'sector_id' => null,
            ],
            [
                'process_name' => 'Регистрация в ЭБС',
                'measurement_id' => 40, // 1 читатель
                'time_in_hours' => null,
                'process_is_daily' => false,
                'requires_description' => false,
                'department_id' => $general->id, // Общие
                'sector_id' => null,
            ],
        ];

        DB::table('processes')->insert($processes);


    }
}
