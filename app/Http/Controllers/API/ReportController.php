<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    // Метод для API (возвращает JSON)
    public function showEmployeeReportApiWEB(Request $request, int $employeeId)
    {
        // Логика для получения данных (как в предыдущих примерах)

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $reportData = $this->employeeReport($employeeId, $startDate, $endDate);

        // Возвращаем JSON-ответ
        return response()->json($reportData, 200);
    }

    public function showEmployeeReportApi($employeeId, $startDate, $endDate)
    {
        $reportData = $this->employeeReport($employeeId, $startDate, $endDate);

        return response()->json($reportData, 200);
    }


    public function getEmployeesByDepartment($departmentId)
    {
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
                'processes.measurement_id',
                'processes.process_duration',
                'processes.is_daily'
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

        // Суммирование данных по датам
        $specificProcessesGrouped = $specificProcesses->groupBy(['process_id', 'date']);

        $specificProcessesByDate = $specificProcessesGrouped->map(function ($group) {
            return $group->map(function ($item) {
                $result = [
                    'process_id' => $item->first()->process_id,
                    'date' => $item->first()->date,
                    'total_quantity' => $item->sum('quantity'), // Количество процессов за дату
                    'total_hours' => $item->sum(function ($process) {
                        return is_numeric($process->quantity)
                            ? $process->quantity * $process->process_duration
                            : 0; // Сумма часов за дату
                    }),
                ];

                if ($item->first()->require_description) {
                    $result['description'] = $item->first()->description;
                }

                return $result;
            });
        })->flatten(1);

        // Сортировка дат по возрастанию
        $specificProcessesByDate = $specificProcessesByDate->sortBy('date');

        // Суммирование данных по всем датам
        $specificProcessesTotal = $specificProcesses->groupBy('process_id')->map(function ($group) {
            $result = [
                'process_id' => $group->first()->process_id,
                'total_quantity' => $group->sum('quantity'), // Общее количество процессов за период
                'total_hours' => $group->sum(function ($process) {
                    return is_numeric($process->quantity)
                        ? $process->quantity * $process->process_duration
                        : 0; // Общая сумма часов за период
                }),
            ];

            if ($group->first()->require_description) {
                $result['description'] = $group->first()->description;
            }

            return $result;
        });

        // Суммарное количество часов по всем датам
        $totalHoursByDate = $specificProcessesByDate->groupBy('date')->map(function ($group) {
            return $group->sum('total_hours');
        });

        // Общая сумма часов за весь период
        $totalHours = $specificProcessesTotal->sum('total_hours');

        // Формирование отчёта
        return [
            'employee_name' => $employee->full_name,
            'specific_processes' => $specificProcessesByDate,
            'specific_processes_total' => $specificProcessesTotal,
            'total_hours_by_date' => $totalHoursByDate,
            'total_hours' => $totalHours,
        ];
    }


    public function generateDepartmentReportApi($departmentId, $startDate, $endDate)
    {
        // Логика для получения данных (как в предыдущих примерах)
        $reportData = $this->departmentReport($departmentId, $startDate, $endDate);

        // Возвращаем JSON-ответ
        return response()->json($reportData, 200);
    }

    public function getDepartments()
    {
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
        // Логика для получения данных (как в предыдущих примерах)
        $reportData = $this->departmentReport($departmentId, $startDate, $endDate);

        // Возвращаем Blade-шаблон с данными
        return view('reports.department_report', ['reportData' => $reportData]);
    }

    public function showDepartmentReport(Request $request, int $departmentId)
    {
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

        // Получение назначений процессов сотрудникам в заданный период
        $processAssignments = DB::table('employee_log_process')
            ->whereIn('employee_id', $employeesInDepartment->pluck('employee_id'))
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where(function ($query) use ($endDate) {
                                $query->whereNull('end_date')
                                    ->orWhere('end_date', '>=', $endDate);
                            });
                    });
            })
            ->select('employee_id', 'process_id', 'start_date', 'end_date')
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
        foreach ($employeesInDepartment as $employee) {
            $employeeProcesses = $processes->where('employee_id', $employee->employee_id);

            $employeeData = [
                'employee_name (ФИО)' => $employee->full_name,
                'processes' => $employeeProcesses->map(function ($process) {
                    return [
                        'process_name' => $process->process_name,
                        'date' => $process->date,
                        'count' => $process->quantity,
                    ];
                })->values(),
                'total_processes_hours' => $employeeProcesses->sum(function ($process) {
                    return $process->quantity * $process->process_duration;
                }),
            ];

            $employees[] = $employeeData;
        }

        // Суммарное количество процессов по всем сотрудникам
        $processCounts = $processes->groupBy('process_id')->map(function ($group) {
            return [
                'process_name' => $group->first()->process_name,
                'total_count' => $group->sum('quantity'),
            ];
        })->values();

        // Формирование отчёта
        return [
            'department_name' => $department->department_name,
            'employees' => $employees,
            'process_count' => $processCounts,
        ];
    }


    public function libraryReportApi($startDate, $endDate)
    {
        $report = $this->libraryReport($startDate, $endDate);

        return response()->json($report);
    }

    /**
     * Получение отчёта по научной библиотеке.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function libraryReport(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Получение данных из таблицы employee_specific_process
        $processes = DB::table('employee_specific_process')
            ->join('processes', 'processes.process_id', '=', 'employee_specific_process.process_id')
            ->whereBetween('employee_specific_process.date', [$startDate, $endDate])
            ->select(
                'processes.process_name',
                'employee_specific_process.date',
                'employee_specific_process.quantity'
            )
            ->get();

        // Группировка данных по процессам и датам
        $groupedProcesses = $processes->groupBy('process_name');

        $report = [
            'dates' => [],
            'processes' => [],
            'total_by_date' => [],
            'total_quantity' => 0,
        ];

        // Формирование отчёта
        foreach ($groupedProcesses as $processName => $data) {
            $processData = [
                'process_name' => $processName,
                'data' => [],
                'total_quantity' => 0,
            ];

            foreach ($data as $item) {
                $date = $item->date;
                $quantity = $item->quantity;

                // Добавление даты в массив дат
                if (!in_array($date, $report['dates'])) {
                    $report['dates'][] = $date;
                }

                // Добавление данных по процессу
                $processData['data'][$date] = $quantity;
                $processData['total_quantity'] += $quantity;

                // Суммирование по датам
                if (!isset($report['total_by_date'][$date])) {
                    $report['total_by_date'][$date] = 0;
                }
                $report['total_by_date'][$date] += $quantity;
            }

            $report['processes'][] = $processData;
            $report['total_quantity'] += $processData['total_quantity'];
        }

        // Сортировка дат
        sort($report['dates']);

        return response()->json([
            'scientific_library_report' => $report,
        ]);
    }
}
