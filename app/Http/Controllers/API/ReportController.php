<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReportController extends Controller
{
    use AuthorizesRequests;
    // Метод для API (возвращает JSON)
    public function showEmployeeReportApiWEB(Request $request, int $employeeId)
    {
        // Проверка прав доступа
        $this->authorize('view', Employee::class);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $reportData = $this->employeeReport($employeeId, $startDate, $endDate);

        // Возвращаем JSON-ответ
        return response()->json($reportData, 200);
    }

    public function showEmployeeReportApi($employeeId, $startDate, $endDate)
    {
        // Проверка прав доступа
        $this->authorize('view', Employee::class);

        $reportData = $this->employeeReport($employeeId, $startDate, $endDate);

        return response()->json($reportData, 200);
    }

    public function getEmployeesByDepartment($departmentId)
    {
        // Проверка прав доступа
        $this->authorize('view', Department::class);

        $employees = DB::table('employees')
            ->where('department_id', $departmentId)
            ->select(
                'employee_id',
                DB::raw("CONCAT(last_name, ' ', first_name, ' ', COALESCE(middle_name, '')) as full_name")
            )
            ->get();

        return response()->json($employees, 200);
    }

    public function showEmployeeReportForm()
    {
        // Проверка прав доступа
        $this->authorize('view', Employee::class);

        // Получение списка сотрудников
        $employees = DB::table('employees')
            ->select(
                'employee_id',
                DB::raw("CONCAT(last_name, ' ', first_name, ' ', COALESCE(middle_name, '')) as full_name")
            )
            ->get();

        return view('reports.employees', ['employees' => $employees]);
    }

    // Метод для Web-представления (возвращает Blade-шаблон)
    public function generateEmployeeReportWeb($employeeId, $startDate, $endDate)
    {
        // Проверка прав доступа
        $this->authorize('view', Employee::class);

        // Логика для получения данных (как в предыдущих примерах)
        $reportData = $this->employeeReport($employeeId, $startDate, $endDate);

        // Возвращаем Blade-шаблон с данными
        return view('reports.employee_report', ['reportData' => $reportData]);
    }

    private function employeeReport($employeeId, $startDate, $endDate)
    {
        // Проверка входных данных
        if (!$employeeId || !$startDate || !$endDate) {
            return response()->json(['error' => 'Необходимо указать ID сотрудника и период.'], 400);
        }

        // Получение данных сотрудника
        $employee = DB::table('employees')
            ->where('employee_id', $employeeId)
            ->select(
                DB::raw("CONCAT(last_name, ' ', first_name, ' ', COALESCE(middle_name, '')) as full_name")
            )
            ->first();

        if (!$employee) {
            return response()->json(['error' => 'Сотрудник не найден.'], 404);
        }

        // Получение данных из таблицы employee_specific_process
        $specificProcesses = DB::table('employee_specific_process')
            ->join('processes', 'processes.process_id', '=', 'employee_specific_process.process_id')
            ->where('employee_id', $employeeId)
            ->whereBetween('date', [$startDate, $endDate])
            ->select(
                'employee_specific_process.process_id',
                'employee_specific_process.date',
                'employee_specific_process.quantity',
                'employee_specific_process.description',
                'processes.require_description',
                'processes.process_duration',
                'processes.is_daily',
                'processes.process_name' // Добавлено для имени процесса
            )
            ->get();

        // Обработка данных
        $specificProcesses = $specificProcesses->map(function ($process) {
            if ($process->is_daily) {
                $process->quantity = 1;
            }

            if ($process->require_description) {
                $process->quantity = $process->quantity; // Для неколичественных процессов количество процессов = 1
                $process->description = $process->description;
            } else {
                $process->quantity = (int)$process->quantity;
                $process->description = null;
            }
            return $process;
        });

        // Группировка данных по датам
        $specificProcessesByDate = $specificProcesses->groupBy('date')->map(function ($processes, $date) {
            return [
                'processes' => $processes->map(function ($process) {
                    return [
                        'process_id' => $process->process_id,
                        'quantity' => $process->quantity,
                        'hours' => $process->quantity * $process->process_duration,
                        'description' => $process->description,
                    ];
                })->values(),
                'total_hours' => $processes->sum(function ($process) {
                    return $process->quantity * $process->process_duration;
                }),
            ];
        })->sortKeys(); // Сортировка по дате (ключу)

        // Суммирование данных по всем датам
        $specificProcessesTotal = $specificProcesses->groupBy('process_id')->map(function ($group) {
            return [
                'total_quantity' => $group->sum('quantity'), // Общее количество процессов за период
                'total_hours' => $group->sum(function ($process) {
                    return $process->quantity * $process->process_duration;
                }),
            ];
        });

        // Суммарное количество часов по всем датам
        $totalHoursByDate = $specificProcessesByDate->map(function ($item) {
            return $item['total_hours'];
        })->sortKeys(); // Сортировка по дате (ключу)

        // Общая сумма часов за весь период
        $totalHours = $specificProcessesTotal->sum('total_hours');

        // Формирование отчёта
        return [
            'employee_name' => $employee->full_name,
            'specific_processes' => $specificProcessesByDate->toArray(), // Дата становится ключом
            'specific_processes_total' => $specificProcessesTotal, // Ключ - process_id
            'total_hours_by_date' => $totalHoursByDate->toArray(), // Сортировка по дате
            'total_hours' => $totalHours,
        ];
    }

    public function generateDepartmentReportApi($departmentId, $startDate, $endDate)
    {
        // Проверка прав доступа
        $this->authorize('viewDepartmentReport', Department::class);

        // Логика для получения данных (как в предыдущих примерах)
        $reportData = $this->departmentReport($departmentId, $startDate, $endDate);

        // Возвращаем JSON-ответ
        return response()->json($reportData, 200);
    }

    public function getDepartments()
    {
        // Проверка прав доступа
        $this->authorize('view', Department::class);

        $departments = DB::table('departments')
            ->select(
                'department_id',
                'department_name'
            )
            ->get();

        return response()->json($departments, 200);
    }

    public function showDepartmentReportForm()
    {
        // Проверка прав доступа
        $this->authorize('view', Department::class);

        // Получение списка сотрудников
        $departments = DB::table('departments')
            ->select(
                'department_id',
                'department_name'
            )
            ->get();

        return view('reports.departments', ['departments' => $departments]);
    }

    // Метод для Web-представления (возвращает Blade-шаблон)
    public function generateDepartmentReportWeb($departmentId, $startDate, $endDate)
    {
        // Проверка прав доступа
        $this->authorize('viewDepartmentReport', Department::class);

        // Логика для получения данных (как в предыдущих примерах)
        $reportData = $this->departmentReport($departmentId, $startDate, $endDate);

        // Возвращаем Blade-шаблон с данными
        return view('reports.department_report', ['reportData' => $reportData]);
    }

    public function showDepartmentReport(Request $request, int $departmentId)
    {
        // Проверка прав доступа
        $this->authorize('view', Department::class);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $report = $this->departmentReport($departmentId, $startDate, $endDate);

        return response()->json($report);
    }

    /**
     * Генерация отчёта по отделу за определённый период.
     *
     * @param int $departmentId
     * @param string $startDate
     * @param string $endDate
     * @return array
     */

    public function departmentReport(int $departmentId, string $startDate, string $endDate): array
    {
        // Получение данных отдела
        $department = DB::table('departments')
            ->where('department_id', $departmentId)
            ->select('department_name')
            ->first();

        if (!$department) {
            return ['error' => 'Отдел не найден.'];
        }

        // Получение сотрудников, работавших в отделе в заданный период
        $employeesInDepartment = DB::table('employee_log_department')
            ->join('employees', 'employees.employee_id', '=', 'employee_log_department.employee_id')
            ->where('department_id', $departmentId)
            ->whereBetween('start_date', [$startDate, $endDate])
            ->where(function ($query) use ($endDate) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $endDate);
            })
            ->select(
                'employees.employee_id',
                DB::raw("CONCAT(employees.last_name, ' ', employees.first_name, ' ', COALESCE(employees.middle_name, '')) as full_name")
            )
            ->get();

        // Получение данных о процессах сотрудников в заданный период
        $processes = DB::table('employee_specific_process')
            ->join('processes', 'processes.process_id', '=', 'employee_specific_process.process_id')
            ->whereIn('employee_specific_process.employee_id', $employeesInDepartment->pluck('employee_id'))
            ->whereBetween('employee_specific_process.date', [$startDate, $endDate])
            ->select(
                'employee_specific_process.employee_id',
                'employee_specific_process.process_id',
                'employee_specific_process.date',
                'employee_specific_process.quantity',
                'processes.process_name',
                'processes.process_duration'
            )
            ->get();

        // Обработка данных
        $employees = [];
        $totalEmployeesCount = 0;
        $totalEmployeesHours = 0;

        foreach ($employeesInDepartment as $employee) {
            $employeeProcesses = $processes->where('employee_id', $employee->employee_id);

            // Группировка процессов по датам
            $processesByDate = $employeeProcesses->groupBy('date')->sortKeys(); // Сортировка дат по возрастанию

            $employeeData = [
                'processes' => [],
                'total_processes_count' => 0,
                'total_processes_hours' => 0,
            ];

            foreach ($processesByDate as $date => $processesOnDate) {
                $processesOnDateGrouped = $processesOnDate->groupBy('process_id');

                // Суммарное количество процессов и часов на дату
                $totalCountOnDate = $processesOnDate->sum('quantity');
                $totalHoursOnDate = $processesOnDate->sum(function ($process) {
                    return $process->quantity * $process->process_duration;
                });

                $employeeData['processes'][$date] = [
                    'processes' => $processesOnDateGrouped->map(function ($group) {
                        return [
                            'process_name' => $group->first()->process_name,
                            'total_count' => $group->sum('quantity'),
                        ];
                    })->values()->toArray(),
                    'total_count' => $totalCountOnDate, // Добавлено поле total_count
                    'total_hours' => $totalHoursOnDate, // Добавлено поле total_hours
                ];

                // Общие суммы для сотрудника
                $employeeData['total_processes_count'] += $totalCountOnDate;
                $employeeData['total_processes_hours'] += $totalHoursOnDate;
            }

            // Добавляем данные сотрудника в массив с ключом ФИО
            $employees[$employee->full_name] = $employeeData;

            // Общие суммы для всех сотрудников
            $totalEmployeesCount += $employeeData['total_processes_count'];
            $totalEmployeesHours += $employeeData['total_processes_hours'];
        }

        // Формирование отчёта
        return [
            'department_name' => $department->department_name,
            'employees' => $employees,
            'total_employees_count' => $totalEmployeesCount,
            'total_employees_hours' => $totalEmployeesHours,
        ];
    }

    public function libraryReportApi($startDate, $endDate)
    {
        // Проверка прав доступа
        $this->authorize('view', Department::class);

        // Логика для получения данных
        $reportData = $this->libraryReport($startDate, $endDate);

        // Возвращаем JSON-ответ
        return response()->json($reportData, 200);
    }

    public function libraryReport(string $startDate, string $endDate): array
    {
        // Получение всех процессов, связанных с научной библиотекой
        $processes = DB::table('processes')
            ->where('department_id', function ($query) {
                $query->select('department_id')
                    ->from('departments')
                    ->where('department_name', 'Научная библиотека');
            })
            ->select('process_id', 'process_name')
            ->get();

        // Получение данных о процессах в заданный период
        $processData = DB::table('employee_specific_process')
            ->join('processes', 'processes.process_id', '=', 'employee_specific_process.process_id')
            ->whereIn('employee_specific_process.process_id', $processes->pluck('process_id'))
            ->whereBetween('employee_specific_process.date', [$startDate, $endDate])
            ->select(
                'employee_specific_process.process_id',
                'employee_specific_process.date',
                'employee_specific_process.quantity',
                'processes.process_name'
            )
            ->get();

        // Обработка данных
        $report = [
            'processes' => [],
            'total_processes' => [
                'total' => 0
            ]
        ];

        // Группировка данных по процессам
        $processesGrouped = $processData->groupBy('process_id');

        foreach ($processesGrouped as $processId => $data) {
            $processName = $data->first()->process_name;

            $processReport = [
                'process_id' => $processId,
                'process_name' => $processName,
                'dates' => [], // Изменено на 'dates'
                'total_count' => 0
            ];

            // Сбор данных по датам
            $dates = $data->pluck('date')->unique()->sort();
            foreach ($dates as $date) {
                $count = $data->where('date', $date)->sum('quantity');
                $processReport['dates'][$date] = $count; // Даты становятся ключами, а значения — количеством
                $processReport['total_count'] += $count;
            }

            $report['processes'][] = $processReport;
        }

        // Суммарное количество процессов по датам
        $allDates = $processData->pluck('date')->unique()->sort();
        foreach ($allDates as $date) {
            $total = $processData->where('date', $date)->sum('quantity');
            $report['total_processes'][$date] = $total; // Даты становятся ключами, а значения — количеством
            $report['total_processes']['total'] += $total;
        }

        return $report;
    }
}
