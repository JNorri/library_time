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

    // // Отношение к модели Measurement
    // public function measurement()
    // {
    //     return $this->belongsTo(Measurement::class, 'measurement_id', 'measurement_id');
    // }

    // // Отношение к модели Department
    // public function department()
    // {
    //     return $this->belongsTo(Department::class, 'department_id', 'department_id');
    // }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'process_employee', 'process_id', 'employee_id')->withPivot('date', 'quantity', 'description');
    }

    public function processes()
    {
        return $this->belongsToMany(Employee::class, 'employee_process', 'process_id', 'employee_id')->withPivot('start_date', 'end_date', 'status');
    }
}
