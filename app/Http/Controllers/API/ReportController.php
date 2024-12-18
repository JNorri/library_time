<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Показать форму для создания отчёта
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Показать отчёт
     */
    public function show(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $report = $this->getFormattedReport($request->start_date, $request->end_date);

        // Если запрос требует JSON ответ - вернём его
        if ($request->wantsJson()) {
            return response()->json($report);
        }

        // Иначе отобразим view
        return view('reports.show', compact('report'));
    }

    /**
     * Получить форматированный отчёт
     */
    private function getFormattedReport($startDate, $endDate)
    {
        $dates = $this->generateDateRange($startDate, $endDate);
        
        $report = DB::table('employees')
            ->leftJoin('employee_log_process', 'employees.id', '=', 'employee_log_process.employee_id')
            ->leftJoin('employee_specific_process', function($join) use ($dates) {
                $join->on('employees.id', '=', 'employee_specific_process.employee_id')
                    ->whereBetween('employee_specific_process.date', [$dates[0], end($dates)]);
            })
            ->select(
                'employees.id',
                'employees.name',
                DB::raw('DATE(employee_specific_process.date) as work_date'),
                DB::raw('SUM(employee_specific_process.quantity) as quantity'),
                DB::raw('TIMESTAMPDIFF(HOUR, employee_log_process.start_date, 
                    COALESCE(employee_log_process.end_date, NOW())) as hours')
            )
            ->groupBy('employees.id', 'employees.name', 'work_date')
            ->get();

        return $this->formatReport($report, $dates);
    }

    private function generateDateRange($start, $end)
    {
        $dates = [];
        $current = strtotime($start);
        $end = strtotime($end);

        while ($current <= $end) {
            $dates[] = date('Y-m-d', $current);
            $current = strtotime('+1 day', $current);
        }

        return $dates;
    }

    private function formatReport($data, $dates)
    {
        $report = [
            'headers' => ['Сотрудник', ...$dates, 'Итого'],
            'rows' => [],
            'totals' => array_fill(0, count($dates) + 2, 0)
        ];

        // Форматирование данных по сотрудникам
        foreach ($data as $row) {
            if (!isset($report['rows'][$row->id])) {
                $report['rows'][$row->id] = [
                    'name' => $row->name,
                    'dates' => array_fill(0, count($dates), ['quantity' => 0, 'hours' => 0]),
                    'total' => 0
                ];
            }

            $dateIndex = array_search($row->work_date, $dates);
            if ($dateIndex !== false) {
                $report['rows'][$row->id]['dates'][$dateIndex] = [
                    'quantity' => $row->quantity,
                    'hours' => $row->hours
                ];
                $report['rows'][$row->id]['total'] += $row->hours;
                $report['totals'][$dateIndex + 1] += $row->hours;
            }
        }

        return $report;
    }

    public function getDepartmentReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'department_id' => 'required|exists:departments,department_id'
        ]);

        $processes = DB::table('processes')
            ->where('department_id', $request->department_id)
            ->get();
        
        $report = DB::table('employees')
            ->join('employee_log_department', function($join) {
                $join->on('employees.employee_id', '=', 'employee_log_department.employee_id')
                    ->whereNull('employee_log_department.end_date');
            })
            ->join('departments', 'employee_log_department.department_id', '=', 'departments.department_id')
            ->leftJoin('employee_specific_process', function($join) use ($request) {
                $join->on('employees.employee_id', '=', 'employee_specific_process.employee_id')
                    ->whereBetween('employee_specific_process.date', [
                        $request->start_date, 
                        $request->end_date
                    ]);
            })
            ->leftJoin('employee_log_process', function($join) {
                $join->on('employees.employee_id', '=', 'employee_log_process.employee_id')
                    ->whereNull('employee_log_process.end_date');
            })
            ->where('departments.department_id', $request->department_id)
            ->select(
                'employees.employee_id',
                'employees.first_name as name',
                'employee_specific_process.process_id',
                DB::raw('SUM(employee_specific_process.quantity) as quantity'),
                DB::raw('EXTRACT(EPOCH FROM (COALESCE(employee_log_process.end_date, NOW()) - 
                    employee_log_process.start_date))/3600 as hours')
            )
            ->groupBy('employees.employee_id', 'employees.first_name', 'employee_specific_process.process_id')
            ->get();

        $formattedReport = [
            'headers' => ['Сотрудник', ...collect($processes)->pluck('process_name'), 'Итого'],
            'rows' => [],
            'totals' => array_fill(0, count($processes) + 2, 0)
        ];

        foreach ($report as $row) {
            if (!isset($formattedReport['rows'][$row->employee_id])) {
                $formattedReport['rows'][$row->employee_id] = [
                    'name' => $row->name,
                    'processes' => array_fill(0, count($processes), ['quantity' => 0, 'hours' => 0]),
                    'total' => 0
                ];
            }

            if ($row->process_id) {
                $processIndex = $processes->search(function($process) use ($row) {
                    return $process->process_id === $row->process_id;
                });

                if ($processIndex !== false) {
                    $formattedReport['rows'][$row->employee_id]['processes'][$processIndex] = [
                        'quantity' => $row->quantity,
                        'hours' => $row->hours
                    ];
                    $formattedReport['rows'][$row->employee_id]['total'] += $row->hours;
                    $formattedReport['totals'][$processIndex + 1] += $row->hours;
                }
            }
        }

        return response()->json($formattedReport);
    }

    public function getLibraryReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $dates = $this->generateDateRange($request->start_date, $request->end_date);
        
        $report = DB::table('processes')
            ->leftJoin('employee_specific_process', function($join) use ($dates) {
                $join->on('processes.id', '=', 'employee_specific_process.process_id')
                    ->whereBetween('employee_specific_process.date', [$dates[0], end($dates)]);
            })
            ->select(
                'processes.id',
                'processes.name',
                DB::raw('DATE(employee_specific_process.date) as work_date'),
                DB::raw('SUM(employee_specific_process.quantity) as quantity')
            )
            ->groupBy('processes.id', 'processes.name', 'work_date')
            ->get();

        $formattedReport = [
            'headers' => ['Процесс', ...$dates, 'Итого'],
            'rows' => [],
            'totals' => array_fill(0, count($dates) + 2, 0)
        ];

        foreach ($report as $row) {
            if (!isset($formattedReport['rows'][$row->id])) {
                $formattedReport['rows'][$row->id] = [
                    'name' => $row->name,
                    'dates' => array_fill(0, count($dates), 0),
                    'total' => 0
                ];
            }

            $dateIndex = array_search($row->work_date, $dates);
            if ($dateIndex !== false) {
                $formattedReport['rows'][$row->id]['dates'][$dateIndex] = $row->quantity;
                $formattedReport['rows'][$row->id]['total'] += $row->quantity;
                $formattedReport['totals'][$dateIndex + 1] += $row->quantity;
            }
        }

        return response()->json($formattedReport);
    }

    public function getEmployeeReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'employee_id' => 'required|exists:employees,employee_id'
        ]);

        $processes = DB::table('processes')
            ->whereExists(function ($query) use ($request) {
                $query->select(DB::raw(1))
                    ->from('employee_specific_process')
                    ->where('employee_specific_process.employee_id', $request->employee_id)
                    ->whereBetween('employee_specific_process.date', [
                        $request->start_date,
                        $request->end_date
                    ])
                    ->whereRaw('employee_specific_process.process_id = processes.process_id');
            })
            ->get();

        $report = DB::table('employees')
            ->where('employees.employee_id', $request->employee_id)
            ->leftJoin('employee_specific_process', function($join) use ($request) {
                $join->on('employees.employee_id', '=', 'employee_specific_process.employee_id')
                    ->whereBetween('employee_specific_process.date', [
                        $request->start_date,
                        $request->end_date
                    ]);
            })
            ->leftJoin('employee_log_process', function($join) {
                $join->on('employees.employee_id', '=', 'employee_log_process.employee_id')
                    ->whereNull('employee_log_process.end_date');
            })
            ->select(
                'employees.employee_id',
                'employees.first_name as name',
                'employee_specific_process.process_id',
                'employee_specific_process.date',
                DB::raw('SUM(employee_specific_process.quantity) as quantity'),
                DB::raw('EXTRACT(EPOCH FROM (COALESCE(employee_log_process.end_date, NOW()) - 
                    employee_log_process.start_date))/3600 as hours')
            )
            ->groupBy(
                'employees.employee_id',
                'employees.first_name',
                'employee_specific_process.process_id',
                'employee_specific_process.date'
            )
            ->get();

        $dates = $this->generateDateRange($request->start_date, $request->end_date);

        $formattedReport = [
            'employee' => $report->first()->name,
            'headers' => ['Процесс', ...$dates, 'Итого'],
            'rows' => [],
            'totals' => array_fill(0, count($dates) + 2, 0)
        ];

        foreach ($processes as $process) {
            if (!isset($formattedReport['rows'][$process->process_id])) {
                $formattedReport['rows'][$process->process_id] = [
                    'name' => $process->process_name,
                    'dates' => array_fill(0, count($dates), ['quantity' => 0, 'hours' => 0]),
                    'total' => 0
                ];
            }
        }

        foreach ($report as $row) {
            if ($row->process_id && $row->date) {
                $dateIndex = array_search(date('Y-m-d', strtotime($row->date)), $dates);
                if ($dateIndex !== false) {
                    $formattedReport['rows'][$row->process_id]['dates'][$dateIndex] = [
                        'quantity' => $row->quantity,
                        'hours' => $row->hours
                    ];
                    $formattedReport['rows'][$row->process_id]['total'] += $row->hours;
                    $formattedReport['totals'][$dateIndex + 1] += $row->hours;
                }
            }
        }

        return response()->json($formattedReport);
    }
}
