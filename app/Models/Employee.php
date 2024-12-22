<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes; // Добавьте это

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes; // Добавьте SoftDeletes

    protected $primaryKey = 'employee_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $dates = [
        'date_of_birth',
        'deleted_at', // Добавьте это
    ];

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function employees()
    {
        return $this->belongsToMany(Process::class, 'employee_specific_process', 'employee_id', 'process_id')
            ->withPivot('date', 'quantity', 'description')
            ->wherePivotNull('deleted_at'); // Фильтрация "удаленных" записей
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'employee_log_department', 'employee_id', 'department_id')
            ->withPivot('start_date', 'end_date')
            ->wherePivotNull('deleted_at'); // Фильтрация "удаленных" записей
    }

    public function processes()
    {
        return $this->belongsToMany(Process::class, 'employee_log_process', 'employee_id', 'process_id')
            ->withPivot('start_date', 'end_date')
            ->wherePivotNull('deleted_at'); // Фильтрация "удаленных" записей
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_log_role', 'employee_id', 'role_id')
            ->wherePivotNull('deleted_at'); // Фильтрация "удаленных" записей
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_log_permission', 'role_id', 'permission_id')
            ->wherePivotIn('role_id', $this->roles->pluck('role_id')->toArray())
            ->wherePivotNull('deleted_at'); // Фильтрация "удаленных" записей
    }

    public function hasPermission($permissionSlug)
    {
        return $this->roles->contains(function ($role) use ($permissionSlug) {
            return $role->permissions->contains('slug', $permissionSlug);
        });
    }
}
