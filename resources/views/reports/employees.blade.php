@extends('reports.index')

@section('report-content')
<table class="w-full">
    <thead>
        <tr>
            <th class="px-4 py-2">Сотрудник</th>
            @foreach($report as $row)
            <th class="px-4 py-2">{{ $row->date }}</th>
            @endforeach
            <th class="px-4 py-2">Итого</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border px-4 py-2">Сотрудник</td>
            @foreach($report as $row)
            <td class="border px-4 py-2">{{ $row->process_count }} ({{ $row->total_duration }} ч.)</td>
            @endforeach
            <td class="border px-4 py-2">{{ $report->sum('total_duration') }} ч.</td>
        </tr>
        <tr>
            <td class="border px-4 py-2">Итого</td>
            @foreach($report as $row)
            <td class="border px-4 py-2">{{ $row->process_count }} ({{ $row->total_duration }} ч.)</td>
            @endforeach
            <td class="border px-4 py-2">{{ $report->sum('total_duration') }} ч.</td>
        </tr>
    </tbody>
</table>
@endsection