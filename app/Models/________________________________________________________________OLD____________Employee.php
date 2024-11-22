<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

// class Employee extends Authenticatable
// {
//     use HasApiTokens, HasFactory, Notifiable;

//     protected $primaryKey = 'employee_id';
//     public $incrementing = false;
//     protected $keyType = 'string';

//     protected $dates = [
//         'date_of_birth',
//     ];

//     protected $fillable = [
//         'first_name',
//         'middle_name',
//         'last_name',
//         'date_of_birth',
//         'phone',
//         'email',
//         'password',
//     ];

//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     protected $casts = [
//         'email_verified_at' => 'datetime',
//         'password' => 'hashed',
//     ];

//     public function employees()
//     {
//         return $this->belongsToMany(Process::class, 'process_employee', 'employee_id', 'process_id')->withPivot('date', 'quantity', 'description');
//     }

//     public function departments()
//     {
//         return $this->belongsToMany(Department::class, 'employee_department', 'employee_id', 'department_id')->withPivot('start_date', 'end_date');
//     }

//     public function processes()
//     {
//         return $this->belongsToMany(Process::class, 'employee_process', 'employee_id', 'process_id')->withPivot('start_date', 'end_date', 'status');
//     }

//     public function roles()
//     {
//         return $this->belongsToMany(Role::class, 'employee_role', 'employee_id', 'role_id');
//     }

//     public function hasPermission($permission)
//     {
//         foreach ($this->roles as $role) {
//             if ($role->permissions->contains('slug', $permission)) {
//                 return true;
//             }
//         }
//         return false;
//     }
// }
