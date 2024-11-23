@extends('reports.index')

@section('report-content')
<table class="w-full">
    <thead>
        <tr>
            <th class="px-4 py-2">Процесс</th>
            @foreach($report as $row)
            <th class="px-4 py-2">{{ $row->date }}</th>
            @endforeach
            <th class="px-4 py-2">Итого</th>
        </tr>
    </thead>
    <tbody>
        @foreach($report->groupBy('process_name') as $processName => $rows)
        <tr>
            <td class="border px-4 py-2">{{ $processName }}</td>
            @foreach($rows as $row)
            <td class="border px-4 py-2">{{ $row->process_count }}</td>
            @endforeach
            <td class="border px-4 py-2">{{ $rows->sum('process_count') }}</td>
        </tr>
        @endforeach
        <tr>
            <td class="border px-4 py-2">Итого</td>
            @foreach($report as $row)
            <td class="border px-4 py-2">{{ $row->process_count }}</td>
            @endforeach
            <td class="border px-4 py-2">{{ $report->sum('process_count') }}</td>
        </tr>
    </tbody>
</table>
@endsection