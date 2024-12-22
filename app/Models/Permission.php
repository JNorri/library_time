<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Добавьте это

class Permission extends Model
{
    use SoftDeletes; // Добавьте это

    protected $primaryKey = 'permission_id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $dates = ['deleted_at']; // Добавьте это

    protected $fillable = [
        'permission_name',
        'permission_description',
        'slug',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Role::class, 'role_log_permission', 'permission_id', 'role_id')
            ->wherePivotNull('deleted_at'); // Фильтрация "удаленных" записей
    }
}
