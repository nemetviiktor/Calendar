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

        OpeningHours::create([
            'dtstart' => '2024-01-08',
            'until' => NULL,
            'freq' => 'weekly',
            'interval' => '2',
            'byweekday' => 'mo',
            'time' => '10:00-12:00'
        ]);

        OpeningHours::create([
            'dtstart' => '2024-01-01',
            'until' => NULL,
            'freq' => 'weekly',
            'interval' => '2',
            'byweekday' => 'we',
            'time' => '12:00-16:00'
        ]);

        OpeningHours::create([
            'dtstart' => '2024-01-01',
            'until' => NULL,
            'freq' => 'weekly',
            'interval' => '1',
            'byweekday' => 'fr',
            'time' => '10:00-16:00'
        ]);

        OpeningHours::create([
            'dtstart' => '2024-06-01',
            'until' => '2024-11-30',
            'freq' => 'weekly',
            'interval' => '1',
            'byweekday' => 'th',
            'time' => '16:00-20:00'
        ]);

        $this->info("Opening hours added successfully!");
    }

}
