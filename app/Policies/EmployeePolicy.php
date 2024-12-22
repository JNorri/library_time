<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\Response;

class EmployeePolicy extends BasePolicy
{
    /**
     * Проверка прав на назначение сотрудника в отдел.
     */
    public function assignToDepartment(Employee $user, Employee $employee)
    {
        return $user->hasPermission('assign')
            ? Response::allow()
            : Response::deny('У вас нет прав для назначения сотрудника в отдел.');
    }

    /**
     * Проверка прав на снятие сотрудника с отдела.
     */
    public function unassignFromDepartment(Employee $user, Employee $employee)
    {
        return $user->hasPermission('unassign')
            ? Response::allow()
            : Response::deny('У вас нет прав для снятия сотрудника с отдела.');
    }
}
