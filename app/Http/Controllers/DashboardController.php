<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Department;
use App\Models\Process;
use App\Models\Measurement;
use App\Models\Employee;
use App\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function roles()
    {
        $roles = Role::all();
        return view('tabs.roles', compact('roles'));
    }

    public function departments()
    {
        $departments = Department::all();
        return view('tabs.departments', compact('departments'));
    }

    public function processes()
    {
        $processes = Process::all();
        return view('tabs.processes', compact('processes'));
    }

    public function measurements()
    {
        $measurements = Measurement::all();
        return view('tabs.measurements', compact('measurements'));
    }

    public function employees()
    {
        $employees = Employee::all();
        return view('tabs.employees', compact('employees'));
    }

    public function permissions()
    {
        $permissions = Permission::all();
        return view('tabs.permissions', compact('permissions'));
    }
}
