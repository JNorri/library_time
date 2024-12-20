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

                    <!-- Фильтры: выбор сотрудника и периода -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <!-- Выпадающий список сотрудников -->
                        <div>
                            <label for="employee" class="block text-sm font-medium text-gray-700">Сотрудник:</label>
                            <select id="employee" name="employee" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" x-model="selectedEmployeeId" @change="loadReport">
                                <option value="">-- Выберите сотрудника --</option>
                                @foreach($employees as $employee)
                                <option value="{{ $employee->employee_id }}">{{ $employee->full_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Выбор начальной даты -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Начальная дата:</label>
                            <input type="date" id="start_date" name="start_date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" x-model="startDate">
                        </div>

                        <!-- Выбор конечной даты -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Конечная дата:</label>
                            <input type="date" id="end_date" name="end_date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" x-model="endDate">
                        </div>
                    </div>

                    <!-- Кнопка для загрузки отчёта -->
                    <div class="mb-6">
                        <button @click="loadReport" class="bg-indigo-500 text-black px-4 py-2 rounded-md hover:bg-black hover:text-white">
                            Загрузить отчёт
                        </button>
                    </div>

                    <!-- Таблица с отчётом -->
                    <div x-show="reportData !== null">
                        <h2 class="text-xl font-bold mb-2">Отчёт для сотрудника: <span x-text="reportData ? reportData.employee_name : ''"></span></h2>
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2">Процесс</th>
                                    <th class="border border-gray-300 px-4 py-2">Дата</th>
                                    <th class="border border-gray-300 px-4 py-2">Количество</th>
                                    <th class="border border-gray-300 px-4 py-2">Часы</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="process in reportData ? reportData.specific_processes : []" :key="process.process_id">
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2" x-text="process.process_id"></td>
                                        <td class="border border-gray-300 px-4 py-2" x-text="process.date"></td>
                                        <td class="border border-gray-300 px-4 py-2" x-text="process.total_quantity"></td>
                                        <td class="border border-gray-300 px-4 py-2" x-text="process.total_hours"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Подключение Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- JavaScript-логика для работы с отчётами -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('report', () => ({
                selectedEmployeeId: '', // Выбранный ID сотрудника
                startDate: '', // Начальная дата
                endDate: '', // Конечная дата
                reportData: null, // Данные отчёта

                // Загрузка отчёта
                loadReport() {
                    if (!this.selectedEmployeeId || !this.startDate || !this.endDate) {
                        alert('Пожалуйста, выберите сотрудника и период.');
                        return;
                    }

                    // Отправка запроса на сервер
                    fetch(`/api/reports/employee/${this.selectedEmployeeId}/${this.startDate}/${this.endDate}`)
                        .then(response => response.json())
                        .then(data => {
                            this.reportData = data; // Сохраняем данные отчёта
                        })
                        .catch(error => {
                            console.error('Ошибка при загрузке отчёта:', error);
                        });
                }
            }));
        });
    </script>
</x-app-layout>