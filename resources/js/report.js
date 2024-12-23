
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
        fetch(`/employee/${employeeId}?start_date=${startDate}&end_date=${endDate}`)
            .then(response => response.json())
            .then(data => {
                // Отображение данных в таблице
                employeeNameSpan.textContent = data.employee_name;
                reportBody.innerHTML = ''; // Очищаем таблицу

                // Создаём шапку таблицы с датами
                const thead = document.createElement('thead');
                const headerRow = document.createElement('tr');
                headerRow.innerHTML = `
                    <th class="border border-gray-300 px-4 py-2">Процесс</th>
                `;

                // Добавляем даты в шапку таблицы
                data.dates.forEach(date => {
                    const th = document.createElement('th');
                    th.className = 'border border-gray-300 px-4 py-2';
                    th.textContent = date;
                    headerRow.appendChild(th);
                });

                // Добавляем столбец "Итого"
                const totalTh = document.createElement('th');
                totalTh.className = 'border border-gray-300 px-4 py-2';
                totalTh.textContent = 'Итого';
                headerRow.appendChild(totalTh);

                thead.appendChild(headerRow);
                reportTable.querySelector('thead').replaceWith(thead);

                // Добавляем строки с процессами
                data.processes.forEach(process => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="border border-gray-300 px-4 py-2">${process.process_name}</td>
                    `;

                    // Добавляем данные по каждой дате
                    data.dates.forEach(date => {
                        const td = document.createElement('td');
                        td.className = 'border border-gray-300 px-4 py-2';
                        if (process.data[date]) {
                            td.textContent = `${process.data[date].quantity} (${process.data[date].hours} ч.)`;
                        } else {
                            td.textContent = '-';
                        }
                        row.appendChild(td);
                    });

                    // Добавляем итог по процессу
                    const totalTd = document.createElement('td');
                    totalTd.className = 'border border-gray-300 px-4 py-2';
                    const totalHours = Object.values(process.data).reduce((sum, item) => sum + item.hours, 0);
                    totalTd.textContent = `${totalHours} ч.`;
                    row.appendChild(totalTd);

                    reportBody.appendChild(row);
                });

                // Добавляем строку с итогами
                const totalRow = document.createElement('tr');
                totalRow.innerHTML = `
                    <td class="border border-gray-300 px-4 py-2"><strong>Итого</strong></td>
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