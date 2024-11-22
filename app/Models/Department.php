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

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_log_department', 'department_id', 'employee_id')->withPivot('start_date', 'end_date');
    }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }

    public function parentDepartment()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    // public function parent()
    // {
    //     return $this->belongsTo(Department::class, 'parent_id');
    // }

    // public function children()
    // {
    //     return $this->hasMany(Department::class, 'parent_id');
    // }
}
