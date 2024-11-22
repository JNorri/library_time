<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Department;
use App\Models\Process;
use App\Models\Measurement;
use App\Models\Employee;
use App\Models\Permission;
use App\Models\User;

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

    public function users()
    {
        $users = User::paginate(10);
        return view('tabs.users', compact('users'));
    }

    public function permissions()
    {
        $permissions = Permission::paginate(10);
        return view('tabs.permissions', compact('permissions'));
    }
}
