<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpeningHours extends Model
{
    protected $table = 'opening_hours';

    protected $fillable = [
        'dtstart',
        'until',
        'freq',
        'interval',
        'byweekday',
        'time'
    ];
}
