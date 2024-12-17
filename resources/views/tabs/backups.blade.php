<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Резервные копии') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Кнопка создания новой резервной копии -->
                    <a href="{{ route('backups.create') }}" class="inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-300 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Создать резервную копию
                    </a>

                    <!-- Сообщения об успехе или ошибке -->
                    @if (session('success'))
                        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Таблица резервных копий -->
                    <table class="w-full mt-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 cursor-pointer" onclick="sortTable(0)">Имя файла</th>
                                <th class="px-4 py-2 cursor-pointer" onclick="sortTable(1)">Дата создания</th>
                                <th class="px-4 py-2">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($backups as $backup)
                                <tr>
                                    <td class="border px-4 py-2">{{ $backup['filename'] }}</td>
                                    <td class="border px-4 py-2">{{ $backup['created_at'] }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('backups.restore', $backup['filename']) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            Восстановить
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>