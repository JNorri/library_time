<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'department_id';
    public $timestamps = false;

    protected $fillable = [
        'department_name',
        'department_description',
        'parent_id',
    ];

    protected $dates = ['deleted_at'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_log_department', 'department_id', 'employee_id')
            ->withPivot('start_date', 'end_date');
    }

    public function parentDepartment()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }
}