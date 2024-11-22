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
        return $this->belongsToMany(Permission::class, 'role_log_permission', 'role_id', 'permission_id');
    }

    public function roles()
    {
        return $this->belongsToMany(User::class, 'user_log_role', 'role_id', 'user_id');
    }
}
