<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Отчёты') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Отчёт по сотруднику</h3>

                    <!-- Форма для выбора отдела, сотрудника и периода -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700">Отдел:</label>
                            <select id="department" name="department" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">-- Выберите отдел --</option>
                            </select>
                        </div>
                        <div>
                            <label for="employee" class="block text-sm font-medium text-gray-700">Сотрудник:</label>
                            <select id="employee" name="employee" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">-- Выберите сотрудника --</option>
                            </select>
                        </div>
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Начальная дата:</label>
                            <input type="date" id="start_date" name="start_date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Конечная дата:</label>
                            <input type="date" id="end_date" name="end_date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        </div>
                    </div>

                    <div class="mb-6">
                        <button id="load-report" class="bg-indigo-500 text-black px-4 py-2 rounded-md hover:bg-black hover:text-white">
                            Загрузить отчёт
                        </button>
                    </div>

                    <!-- Таблица с отчётом -->
                    <div id="report-table" class="hidden overflow-x-auto">
                        <h2 class="text-xl font-bold mb-2">Отчёт для сотрудника: <span id="employee-name"></span></h2>

                        <!-- Контейнер для таблицы -->
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 sticky left-0 bg-white z-20">Сотрудник</th>
                                        <!-- Динамические даты будут добавляться сюда -->
                                        <th class="border border-gray-300 px-4 py-2 sticky right-0 bg-white z-20">Итого</th>
                                    </tr>
                                </thead>
                                <tbody id="report-body">
                                    <!-- Данные будут добавлены динамически -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Подключение JavaScript-файла -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const employeeSelect = document.getElementById('employee');
            const departmentSelect = document.getElementById('department');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const loadReportButton = document.getElementById('load-report');
            const reportTable = document.getElementById('report-table');
            const reportBody = document.getElementById('report-body');
            const employeeNameSpan = document.getElementById('employee-name');

            // Загрузка списка отделов
            fetch('/department/all')
                .then(response => response.json())
                .then(data => {
                    data.forEach(department => {
                        const option = document.createElement('option');
                        option.value = department.department_id;
                        option.textContent = department.department_name;
                        departmentSelect.appendChild(option);
                    });
                });

            // Загрузка списка сотрудников по отделу
            departmentSelect.addEventListener('change', () => {
                const departmentId = departmentSelect.value;
                employeeSelect.innerHTML = '<option value="">-- Выберите сотрудника --</option>';

                if (departmentId) {
                    fetch(`/report/employees-by-department/${departmentId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(employee => {
                                const option = document.createElement('option');
                                option.value = employee.employee_id;
                                option.textContent = employee.full_name;
                                employeeSelect.appendChild(option);
                            });
                        });
                }
            });

            // Обработка нажатия на кнопку "Загрузить отчёт"
            loadReportButton.addEventListener('click', () => {
                const employeeId = employeeSelect.value;
                const startDate = startDateInput.value;
                const endDate = endDateInput.value;

                if (!employeeId || !startDate || !endDate) {
                    alert('Пожалуйста, выберите сотрудника и период.');
                    return;
                }

                // Загрузка данных отчёта
                fetch(`/report/employee/${employeeId}?start_date=${startDate}&end_date=${endDate}`)
                    .then(response => response.json())
                    .then(data => {
                        // Отображение данных в таблице
                        employeeNameSpan.textContent = data.employee_name;
                        reportBody.innerHTML = ''; // Очищаем таблицу

                        // Создаём шапку таблицы с датами
                        const thead = document.createElement('thead');
                        const headerRow = document.createElement('tr');
                        headerRow.innerHTML = `
                            <th class="border border-gray-300 px-4 py-2 sticky left-0 bg-white z-20">${employeeNameSpan.textContent}</th>
                        `;

                        // Добавляем даты в шапку таблицы
                        data.dates.forEach(date => {
                            const th = document.createElement('th');
                            th.className = 'border border-gray-300 px-4 py-2 sticky top-0 bg-white z-10';
                            th.textContent = date;
                            headerRow.appendChild(th);
                        });

                        // Добавляем итоговый столбец
                        const totalTh = document.createElement('th');
                        totalTh.className = 'border border-gray-300 px-4 py-2 sticky right-0 bg-white z-20';
                        totalTh.textContent = 'Итого';
                        headerRow.appendChild(totalTh);

                        thead.appendChild(headerRow);
                        reportTable.querySelector('thead').replaceWith(thead);

                        // Добавляем строки с процессами
                        data.processes.forEach(process => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td class="border border-gray-300 px-4 py-2 sticky left-0 bg-white z-20">${process.process_name}</td>
                            `;

                            // Добавляем данные по каждой дате
                            data.dates.forEach(date => {
                                const td = document.createElement('td');
                                td.className = 'border border-gray-300 px-4 py-2';
                                td.textContent = process.data[date] ? `${process.data[date].quantity} (${process.data[date].hours} ч.)` : '-';
                                row.appendChild(td);
                            });

                            // Добавляем итог по процессу за весь период
                            const totalTd = document.createElement('td');
                            totalTd.className = 'border border-gray-300 px-4 py-2 sticky right-0 bg-white z-20';
                            totalTd.textContent = `${data.total_processes[process.process_id] ?? 0}`;
                            row.appendChild(totalTd);

                            reportBody.appendChild(row);
                        });

                        // Добавляем строку с итогами
                        const totalRow = document.createElement('tr');
                        totalRow.innerHTML = `
                            <td class="border border-gray-300 px-4 py-2 sticky left-0 bg-white z-20"><strong>Итого</strong></td>
                        `;

                        // Добавляем итоги по каждой дате
                        data.dates.forEach(date => {
                            const td = document.createElement('td');
                            td.className = 'border border-gray-300 px-4 py-2';
                            td.textContent = `${data.totals_by_date[date] ?? 0} ч.`;
                            totalRow.appendChild(td);
                        });

                        // Добавляем общий итог
                        const totalTd = document.createElement('td');
                        totalTd.className = 'border border-gray-300 px-4 py-2';
                        totalTd.textContent = `${data.total_hours} ч.`;
                        totalRow.appendChild(totalTd);

                        reportBody.appendChild(totalRow);

                        // Показываем таблицу
                        reportTable.classList.remove('hidden');
                    });
            });
        });
    </script>

    <style>
        /* Фиксируем первый столбец (Сотрудник) */
        td:first-child,
        th:first-child {
            position: sticky;
            left: 0;
            background-color: white;
            z-index: 10;
        }

        /* Фиксируем последний столбец (Итого) */
        td:last-child,
        th:last-child {
            position: sticky;
            right: 0;
            background-color: white;
            z-index: 10;
        }

        /* Общие стили для таблицы */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        thead th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</x-app-layout>