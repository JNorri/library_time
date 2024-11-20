<div x-data="{ activeTab: 'employees' }" class="p-6">
    <div class="flex space-x-4 border-b">
        <button
            @click="activeTab = 'employees'"
            :class="{ 'border-b-2 border-blue-500': activeTab === 'employees' }"
            class="py-2 px-4 text-gray-600 hover:text-gray-800">
            Сотрудники
        </button>
        <button
            @click="activeTab = 'measurements'"
            :class="{ 'border-b-2 border-blue-500': activeTab === 'measurements' }"
            class="py-2 px-4 text-gray-600 hover:text-gray-800">
            Единицы измерения
        </button>
        <button
            @click="activeTab = 'processes'"
            :class="{ 'border-b-2 border-blue-500': activeTab === 'processes' }"
            class="py-2 px-4 text-gray-600 hover:text-gray-800">
            Процессы
        </button>
        <button
            @click="activeTab = 'departments'"
            :class="{ 'border-b-2 border-blue-500': activeTab === 'departments' }"
            class="py-2 px-4 text-gray-600 hover:text-gray-800">
            Отделы
        </button>
        <button
            @click="activeTab = 'roles'"
            :class="{ 'border-b-2 border-blue-500': activeTab === 'roles' }"
            class="py-2 px-4 text-gray-600 hover:text-gray-800">
            Роли
        </button>
        <button
            @click="activeTab = 'permissions'"
            :class="{ 'border-b-2 border-blue-500': activeTab === 'permissions' }"
            class="py-2 px-4 text-gray-600 hover:text-gray-800">
            Разрешения
        </button>
    </div>

    <div class="mt-4">
        <div x-show="activeTab === 'employees'">
            <h2 class="text-lg font-semibold">Сотрудники</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Фамилия</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Отчество</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата рождения</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($employees as $employee)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->last_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->first_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->middle_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->date_of_birth }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->phone }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div x-show="activeTab === 'measurements'">
            <h2 class="text-lg font-semibold">Единицы измерения</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Описание</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($measurements as $measurement)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $measurement->measurement_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $measurement->measurement_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $measurement->measurement_description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div x-show="activeTab === 'processes'">
            <h2 class="text-lg font-semibold">Процессы</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Единица измерения</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ежедневный</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Требует описания</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Отдел</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Длительность</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($processes as $process)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $process->process_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $process->process_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $process->measurement_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $process->is_daily ? 'Да' : 'Нет' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $process->require_description ? 'Да' : 'Нет' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $process->department_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $process->process_duration }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div x-show="activeTab === 'departments'">
            <h2 class="text-lg font-semibold">Отделы</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Описание</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Родительский отдел</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($departments as $department)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $department->department_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $department->department_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $department->department_description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $department->parent_id }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div x-show="activeTab === 'roles'">
            <h2 class="text-lg font-semibold">Роли</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Описание</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($roles as $role)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $role->role_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $role->role_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $role->slug }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $role->role_description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div x-show="activeTab === 'permissions'">
            <h2 class="text-lg font-semibold">Разрешения</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Описание</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($permissions as $permission)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $permission->permission_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $permission->permission_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $permission->slug }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $permission->permission_description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>