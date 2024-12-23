<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Measurement extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'measurement_id';
    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'measurement_name',
        'measurement_description',
    ];
}
