<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'role_id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'role_name',
        'role_description',
        'slug',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_log_permission', 'role_id', 'permission_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Employee::class, 'employee_log_role', 'role_id', 'employee_id');
    }
}
