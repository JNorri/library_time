<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy extends BasePolicy
{
    /**
     * Проверка прав на назначение процесса отделу.
     */
    public function assignProcess(Employee $user, Department $department)
    {
        return $user->hasPermission('assign')
            ? Response::allow()
            : Response::deny('У вас нет прав для назначения процесса.');
    }

    /**
     * Проверка прав на снятие процесса с отдела.
     */
    public function unassignProcess(Employee $user, Department $department)
    {
        return $user->hasPermission('unassign')
            ? Response::allow()
            : Response::deny('У вас нет прав для снятия процесса.');
    }
}
