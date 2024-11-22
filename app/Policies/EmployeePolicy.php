<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
{
    use HandlesAuthorization;
    // /**
    //  * Determine whether the employee can view any models.
    //  */
    // public function viewAny(User $employee): bool
    // {
    //     //
    // }

    /**
     * Determine whether the employee can view the model.
     */
    public function view(Employee $employee, Employee $model)
    {
        return $employee->id === $model->id;
    }

    // /**
    //  * Determine whether the employee can create models.
    //  */
    // public function create(User $employee): bool
    // {
    //     //
    // }

    /**
     * Determine whether the employee can update the model.
     */
    public function update(Employee $employee, Employee $model)
    {
        return $employee->id === $model->id;
    }


    /**
     * Determine whether the employee can delete the model.
     */
    public function delete(Employee $employee, Employee $model)
    {
        return $employee->id === $model->id;
    }

    // /**
    //  * Determine whether the employee can restore the model.
    //  */
    // public function restore(User $employee, User $employee): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the employee can permanently delete the model.
    //  */
    // public function forceDelete(User $employee, User $employee): bool
    // {
    //     //
    // }
}
