<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'process_id';
    public $timestamps = false;

    protected $dates = ['deleted_at'];

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
        return $this->belongsToMany(Employee::class, 'employee_specific_process', 'process_id', 'employee_id')
            ->withPivot('date', 'quantity', 'description');
    }

    public function processes()
    {
        return $this->belongsToMany(Employee::class, 'employee_log_process', 'process_id', 'employee_id')
            ->withPivot('start_date', 'end_date');
    }

    public function measurement()
    {
        return $this->belongsTo(Measurement::class, 'measurement_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
