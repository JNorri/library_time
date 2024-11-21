<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Processes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Process ID</th>
                                <th class="px-4 py-2">Process Name</th>
                                <th class="px-4 py-2">Measurement Name</th>
                                <th class="px-4 py-2">Is Daily</th>
                                <th class="px-4 py-2">Require Description</th>
                                <th class="px-4 py-2">Department Name</th>
                                <th class="px-4 py-2">Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($processes as $process)
                            <tr>
                                <td class="border px-4 py-2">{{ $process->process_id }}</td>
                                <td class="border px-4 py-2">{{ $process->process_name }}</td>
                                <td class="border px-4 py-2">{{ $process->measurement->measurement_name }}</td>
                                <td class="border px-4 py-2">{{ $process->is_daily ? 'Yes' : 'No' }}</td>
                                <td class="border px-4 py-2">{{ $process->require_description ? 'Yes' : 'No' }}</td>
                                <td class="border px-4 py-2">{{ $process->department->department_name }}</td>
                                <td class="border px-4 py-2">{{ $process->process_duration }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $processes->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>