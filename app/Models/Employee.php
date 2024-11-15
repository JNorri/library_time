<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'phone',
        'department_id',
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
        return $this->belongsToMany(Process::class, 'processes_employees', 'employee_id', 'process_id')->withPivot('date', 'quantity', 'description');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'employees_departments', 'employee_id', 'department_id')->withPivot('start_date', 'end_date');
    }

    public function processes()
    {
        return $this->belongsToMany(Process::class, 'employees_processes', 'employee_id', 'process_id')->withPivot('start_date', 'end_date', 'status');
    }
}
