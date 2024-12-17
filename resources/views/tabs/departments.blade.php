<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Отделы') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 cursor-pointer" onclick="sortTable(0)">ID отдела</th>
                                <th class="px-4 py-2 cursor-pointer" onclick="sortTable(1)">Название отдела</th>
                                <th class="px-4 py-2 cursor-pointer" onclick="sortTable(2)">Описание</th>
                                <th class="px-4 py-2 cursor-pointer" onclick="sortTable(3)">Родительский отдел</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                            <tr>
                                <td class="border px-4 py-2">{{ $department->department_id }}</td>
                                <td class="border px-4 py-2">{{ $department->department_name }}</td>
                                <td class="border px-4 py-2">{{ $department->department_description }}</td>
                                <td class="border px-4 py-2">
                                    @if($department->parentDepartment)
                                    {{ $department->parentDepartment->department_name }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <!-- <td class="border p-2">
                                    <button data-id="{{ $department->department_id }}" class="edit-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                        </svg>
                                    </button>
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $departments->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно -->
    <!-- <script src="{{ asset('js/modal.js') }}"></script> -->

    @include('modals.edit')
</x-app-layout>