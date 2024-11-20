<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Measurements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Measurement ID</th>
                                <th class="px-4 py-2">Measurement Name</th>
                                <th class="px-4 py-2">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($measurements as $measurement)
                            <tr>
                                <td class="border px-4 py-2">{{ $measurement->measurement_id }}</td>
                                <td class="border px-4 py-2">{{ $measurement->measurement_name }}</td>
                                <td class="border px-4 py-2">{{ $measurement->measurement_description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>