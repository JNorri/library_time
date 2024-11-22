<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    // protected $primaryKey = 'user_id';
    public $incrementing = true;
    // protected $keyType = 'int';

    protected $dates = [
        'date_of_birth',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function users()
    {
        return $this->belongsToMany(Process::class, 'user_specific_process', 'user_id', 'process_id')->withPivot('date', 'quantity', 'description');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'user_log_department', 'user_id', 'department_id')->withPivot('start_date', 'end_date');
    }

    public function processes()
    {
        return $this->belongsToMany(Process::class, 'user_log_process', 'user_id', 'process_id')->withPivot('start_date', 'end_date');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_log_role', 'user_id', 'role_id');
    }

    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('slug', $permission)) {
                return true;
            }
        }
        return false;
    }


    // public function departments()
    // {
    //     return $this->belongsToMany(Department::class);
    // }
}
