<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{

    protected $primaryKey = 'process_id';

    protected $fillable = [
        'process_name',
        'is_daily',
        'require_description',
        'department_id',
        'measurement_id',
        'process_duration',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'processes_employees', 'process_id', 'employee_id')->withPivot('date', 'quantity', 'description');
    }

    public function processes()
    {
        return $this->belongsToMany(Employee::class, 'employees_processes', 'process_id', 'employee_id')->withPivot('date');
    }
}
