<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OpeningHours;

class SeedOpeningHours extends Command
{
    protected $signature = "seed:opening-hours";

    public function handle()
    {
        OpeningHours::create([
           'dtstart' => '2024-09-08',
            'until' => NULL,
            'freq' => NULL,
            'interval' => NULL,
            'byweekday' => NULL,
            'time' => '08:00-10:00'
        ]);

        $this->info("Opening hours added successfully!");
    }

}
