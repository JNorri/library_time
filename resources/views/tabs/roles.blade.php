<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Роли') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID роли</th>
                                <th class="px-4 py-2">Название роли</th>
                                <th class="px-4 py-2">Slug</th>
                                <th class="px-4 py-2">Описание</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td class="border px-4 py-2">{{ $role->role_id }}</td>
                                <td class="border px-4 py-2">{{ $role->role_name }}</td>
                                <td class="border px-4 py-2">{{ $role->slug }}</td>
                                <td class="border px-4 py-2">{{ $role->role_description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roles->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>