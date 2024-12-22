<?php
namespace App\Policies;

use App\Models\Role;
use App\Models\Employee;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Проверка прав на назначение разрешения роли.
     */
    public function assignPermissionToRole(Employee $user, Role $role)
    {
        return $user->hasPermission('assign')
            ? Response::allow()
            : Response::deny('У вас нет прав для назначения разрешений роли.');
    }

    /**
     * Проверка прав на снятие разрешения с роли.
     */
    public function unassignPermissionFromRole(Employee $user, Role $role)
    {
        return $user->hasPermission('unassign')
            ? Response::allow()
            : Response::deny('У вас нет прав для снятия разрешений с роли.');
    }
}