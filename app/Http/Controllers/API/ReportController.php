<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function employeeReport(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $report = $this->getEmployeeReport($employeeId, $startDate, $endDate);

        return view('reports.employee', compact('report'));
    }

    public function departmentReport(Request $request)
    {
        $departmentId = $request->input('department_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $report = $this->getDepartmentReport($departmentId, $startDate, $endDate);

        return view('reports.department', compact('report'));
    }

    public function libraryReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $report = $this->getLibraryReport($startDate, $endDate);

        return view('reports.library', compact('report'));
    }

    // Методы getEmployeeReport, getDepartmentReport, getLibraryReport
    private function getEmployeeReport($employeeId, $startDate, $endDate)
    {
        return DB::table('employee_log_process')
            ->join('processes', 'employee_log_process.process_id', '=', 'processes.process_id')
            ->select(DB::raw('DATE(employee_log_process.start_date) as date'), DB::raw('COUNT(*) as process_count'), DB::raw('SUM(processes.process_duration) as total_duration'))
            ->where('employee_log_process.employee_id', $employeeId)
            ->whereNull('employee_log_process.end_date')
            ->whereBetween('employee_log_process.start_date', [$startDate, $endDate])
            ->groupBy('date')
            ->get();
    }

    private function getDepartmentReport($departmentId, $startDate, $endDate)
    {
        return DB::table('employee_log_process')
            ->join('processes', 'employee_log_process.process_id', '=', 'processes.process_id')
            ->select('processes.process_name', DB::raw('COUNT(*) as process_count'), DB::raw('SUM(processes.process_duration) as total_duration'))
            ->where('processes.department_id', $departmentId)
            ->whereNull('employee_log_process.end_date')
            ->whereBetween('employee_log_process.start_date', [$startDate, $endDate])
            ->groupBy('processes.process_name')
            ->get();
    }

    private function getLibraryReport($startDate, $endDate)
    {
        return DB::table('employee_log_process')
            ->join('processes', 'employee_log_process.process_id', '=', 'processes.process_id')
            ->select('processes.process_name', DB::raw('DATE(employee_log_process.start_date) as date'), DB::raw('COUNT(*) as process_count'))
            ->whereNull('employee_log_process.end_date')
            ->whereBetween('employee_log_process.start_date', [$startDate, $endDate])
            ->groupBy('processes.process_name', 'date')
            ->get();
    }
}
