<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $primaryKey = 'measurement_id';

    //
    protected $fillable = [
        'measurement_name',
        'measurement_description',
    ];
}
