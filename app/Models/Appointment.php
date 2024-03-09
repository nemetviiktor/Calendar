<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'recurring',
        'start',
        'end',
        'date',
        'time'
    ];
}
