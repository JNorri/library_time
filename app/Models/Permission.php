<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $primaryKey = 'permission_id'; // Указываем пользовательский первичный ключ
    public $incrementing = true; // Указываем, что первичный ключ является автоинкрементным
    protected $keyType = 'integer'; // Указываем тип первичного ключа

    protected $fillable = [
        'permission_name',
        'permission_description',
        'slug'

    ];

    public function permissions()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }
}
