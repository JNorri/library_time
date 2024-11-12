<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    //
    protected $fillable = [
        'process_name',
        'measurement_id',
        'process_is_daily',
        'process_description',

    ];
}
