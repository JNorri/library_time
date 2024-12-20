<?php

// namespace App\Policies;

// use App\Models\Employee;
// use App\Models\Role;
// use Illuminate\Auth\Access\Response;
// use Illuminate\Auth\Access\HandlesAuthorization;

// class RolePolicy
// {
//     use HandlesAuthorization;

//     public function viewAny(Employee $user)
//     {
//         return $user->hasPermission('view_role');
//     }

//     public function view(Employee $user, Role $role)
//     {
//         return $user->hasPermission('view_role');
//     }

//     public function create(Employee $user)
//     {
//         return $user->hasPermission('create_role');
//     }

//     public function update(Employee $user, Role $role)
//     {
//         return $user->hasPermission('edit_role');
//     }

//     public function delete(Employee $user, Role $role)
//     {
//         return $user->hasPermission('delete_role');
//     }
// }
