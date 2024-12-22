<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Process;
use Illuminate\Auth\Access\Response;

class ProcessPolicy extends BasePolicy
{
    /**
     * Проверка прав на назначение процесса сотруднику.
     */
    public function assignToEmployee(Employee $user, Process $process)
    {
        return $user->hasPermission('assign')
            ? Response::allow()
            : Response::deny('У вас нет прав для назначения процесса сотруднику.');
    }

    /**
     * Проверка прав на снятие процесса с сотрудника.
     */
    public function unassignFromEmployee(Employee $user, Process $process)
    {
        return $user->hasPermission('unassign')
            ? Response::allow()
            : Response::deny('У вас нет прав для снятия процесса с сотрудника.');
    }
}
