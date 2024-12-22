<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Добавьте это

class Measurement extends Model
{
    use SoftDeletes; // Добавьте это

    protected $primaryKey = 'measurement_id';
    public $timestamps = false;

    protected $dates = ['deleted_at']; // Добавьте это

    protected $fillable = [
        'measurement_name',
        'measurement_description',
    ];
}
