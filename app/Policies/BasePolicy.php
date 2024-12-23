<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BasePolicy
{
    use HandlesAuthorization;

    /**
     * Проверка прав на просмотр списка ресурсов.
     */
    public function viewAny(Employee $user)
    {
        return $user->hasPermission('view_any')
            ? Response::allow()
            : Response::deny('У вас нет прав для просмотра списка.');
    }

    /**
     * Проверка прав на просмотр конкретного ресурса.
     */
    public function view(Employee $user)
    {
        return $user->hasPermission('view')
            ? Response::allow()
            : Response::deny('У вас нет прав для просмотра.');
    }

    /**
     * Проверка прав на создание ресурса.
     */
    public function create(Employee $user)
    {
        return $user->hasPermission('create')
            ? Response::allow()
            : Response::deny('У вас нет прав для создания.');
    }

    /**
     * Проверка прав на обновление ресурса.
     */
    public function update(Employee $user)
    {
        return $user->hasPermission('update')
            ? Response::allow()
            : Response::deny('У вас нет прав для редактирования.');
    }

    /**
     * Проверка прав на удаление ресурса.
     */
    public function delete(Employee $user)
    {
        return $user->hasPermission('delete')
            ? Response::allow()
            : Response::deny('У вас нет прав для удаления.');
    }

    /**
     * Проверка прав на назначение.
     */
    public function assign(Employee $user)
    {
        return $user->hasPermission('assign')
            ? Response::allow()
            : Response::deny('У вас нет прав для назначения.');
    }

    /**
     * Проверка прав на назначение.
     */
    public function unassign(Employee $user)
    {
        return $user->hasPermission('unassign')
            ? Response::allow()
            : Response::deny('У вас нет прав для снятия.');
    }
}
