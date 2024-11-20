<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Department ID</th>
                                <th class="px-4 py-2">Department Name</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Parent ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                            <tr>
                                <td class="border px-4 py-2">{{ $department->department_id }}</td>
                                <td class="border px-4 py-2">{{ $department->department_name }}</td>
                                <td class="border px-4 py-2">{{ $department->department_description }}</td>
                                <td class="border px-4 py-2">{{ $department->parent_id }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>