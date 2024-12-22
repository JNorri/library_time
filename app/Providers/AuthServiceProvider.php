<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Process;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Measurement;
use App\Models\Report;
use App\Policies\DepartmentPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\ProcessPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\MeasurementPolicy;
use App\Policies\ReportPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Department::class => DepartmentPolicy::class,
        Employee::class => EmployeePolicy::class,
        Process::class => ProcessPolicy::class,
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
        Measurement::class => MeasurementPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Дополнительные настройки авторизации можно добавить здесь
    }
}
