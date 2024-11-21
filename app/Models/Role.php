<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $primaryKey = 'role_id'; // Указываем пользовательский первичный ключ
    public $incrementing = true; // Указываем, что первичный ключ является автоинкрементным
    protected $keyType = 'integer'; // Указываем тип первичного ключа
    public $timestamps = false; // Отключаем автоматическое управление временными метками
    protected $fillable = [
        'role_name',
        'role_description',
        'slug'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Employee::class, 'employee_role', 'role_id', 'employee_id');
    }
}
