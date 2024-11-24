<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Измерения') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID измерения</th>
                                <th class="px-4 py-2">Название измерения</th>
                                <th class="px-4 py-2">Описание</th>
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
                    {{ $measurements->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>