<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
{
    use HandlesAuthorization;
    /**
     * Проверка, может ли пользователь просматривать список сотрудников.
     */
    public function viewAny(Employee $user)
    {
        return $user->hasPermission('view_employee');
    }

    /**
     * Проверка, может ли пользователь просматривать конкретного сотрудника.
     */
    public function view(Employee $user, Employee $employee)
    {
        return $user->hasPermission('view_employee');
    }

    /**
     * Проверка, может ли пользователь создавать сотрудников.
     */
    public function create(Employee $user)
    {
        return $user->hasPermission('create_employee');
    }

    /**
     * Проверка, может ли пользователь обновлять данные сотрудника.
     */
    public function update(Employee $user, Employee $employee)
    {
        return $user->hasPermission('edit_employee');
    }

    /**
     * Проверка, может ли пользователь удалять сотрудника.
     */
    public function delete(Employee $user, Employee $employee)
    {
        return $user->hasPermission('delete_employee');
    }

    /**
     * Проверка, может ли пользователь восстанавливать удаленного сотрудника.
     */
    public function restore(Employee $user, Employee $employee)
    {
        return $user->hasPermission('restore_employee');
    }

    /**
     * Проверка, может ли пользователь принудительно удалить сотрудника.
     */
    public function forceDelete(Employee $user, Employee $employee)
    {
        return $user->hasPermission('force_delete_employee');
    }
}


