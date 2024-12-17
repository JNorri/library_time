<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Department;
use App\Models\Process;
use App\Models\Measurement;
use App\Models\Employee;
use App\Models\Permission;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function roles()
    {
        $roles = Role::paginate(10);
        return view('tabs.roles', compact('roles'));
    }

    public function departments()
    {
        $departments = Department::with('parentDepartment')->paginate(10);
        return view('tabs.departments', compact('departments'));
    }

    public function processes()
    {
        $processes = Process::with('measurement', 'department')->paginate(10);
        return view('tabs.processes', compact('processes'));
    }

    public function measurements()
    {
        $measurements = Measurement::paginate(10);
        return view('tabs.measurements', compact('measurements'));
    }

    public function employees()
    {
        $employees = Employee::paginate(10);
        return view('tabs.employees', compact('employees'));
    }

    public function permissions()
    {
        $permissions = Permission::paginate(10);
        return view('tabs.permissions', compact('permissions'));
    }

    public function backups()
    {
        // Получаем список резервных копий из BackupController
        $backups = collect(Storage::disk('local')->files('backups'))
            ->map(function ($file) {
                return [
                    'filename' => basename($file),
                    'created_at' => date('Y-m-d H:i:s', Storage::disk('local')->lastModified($file)),
                ];
            })
            ->sortByDesc('created_at')
            ->values()
            ->all();

        return view('tabs.backups', compact('backups'));
    }

    public function reports()
    {
        // Пример данных для отчетов
        $reports = [
            ['id' => 1, 'title' => 'Отчет за Январь', 'created_at' => '2023-01-01 10:00:00'],
            ['id' => 2, 'title' => 'Отчет за Февраль', 'created_at' => '2023-02-01 12:00:00'],
            // Добавьте больше данных по мере необходимости
        ];

        return view('tabs.reports', compact('reports'));
    }
}
