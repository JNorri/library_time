<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $primaryKey = 'department_id';

    public $timestamps = false;

    protected $fillable = [
        'department_name',
        'department_description',
        'parent_id',
    ];

    public function departments()
    {
        return $this->belongsToMany(Employee::class, 'employees_departments', 'department_id', 'employee_id')->withPivot('start_date', 'end_date');
    }
}
