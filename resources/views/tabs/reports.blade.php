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
                    <div class="mb-4">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8">
                                <a href="{{ route('reports.employees') }}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('reports.employees') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                    {{ __('Отчёт по сотруднику') }}
                                </a>
                                <a href="{{ route('reports.departments') }}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('reports.departments') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                    {{ __('Отчёт по отделу') }}
                                </a>
                                <a href="{{ route('reports.library') }}" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('reports.library') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                    {{ __('Отчёт по библиотеке') }}
                                </a>
                            </nav>
                        </div>
                    </div>
                    @yield('report-content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>