<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpeningHours extends Model
{
    protected $table = 'opening_hours';

    protected $fillable = [
        'startRecur',
        'endRecur',
        'recurring',
        'daysOfWeek',
        'time'
    ];
}
