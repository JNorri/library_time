<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Сотрудники') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID сотрудника</th>
                                <th class="px-4 py-2">Фамилия</th>
                                <th class="px-4 py-2">Имя</th>
                                <th class="px-4 py-2">Отчество</th>
                                <th class="px-4 py-2">Дата рождения</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Телефон</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td class="border px-4 py-2">{{ $employee->employee_id }}</td>
                                <td class="border px-4 py-2">{{ $employee->last_name }}</td>
                                <td class="border px-4 py-2">{{ $employee->first_name }}</td>
                                <td class="border px-4 py-2">{{ $employee->middle_name }}</td>
                                <td class="border px-4 py-2">{{ $employee->date_of_birth }}</td>
                                <td class="border px-4 py-2">{{ $employee->email }}</td>
                                <td class="border px-4 py-2">{{ $employee->phone }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>