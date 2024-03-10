<?php

namespace App\Http\Controllers;

use App\Models\OpeningHours;
use App\Helpers\OpeningHoursUtility;

class OpeningHoursController extends Controller
{
    public function getOpeningHours()
    {
        $openingHours = OpeningHours::all();
        $data = [];

        $openingHoursUtility = new OpeningHoursUtility();

        foreach ($openingHours as $openingHour) {
            if ($openingHour->freq !== null)
            {
                $data[] = [
                    'display' => 'background',
                    'rrule' => [
                        'freq' => $openingHour->freq,
                        'interval' => $openingHour->interval,
                        'byweekday' => [(int) $openingHour->byweekday], //több nappal nem lesz jó
                        'dtstart' => $openingHoursUtility->getDtStart($openingHour->dtstart, $openingHour->time),
                        'until' => $openingHour->until
                    ],
                    'duration' => $openingHoursUtility->getDuration($openingHour->time)
                ];
            }
            else
            {
                $data[] = [
                    'display' => 'background',
                    'start' => $openingHoursUtility->getDtStart($openingHour->dtstart, $openingHour->time),
                    'end' => $openingHoursUtility->getEnd($openingHour->dtstart, $openingHour->time),
                ];
            }
        }
        return response()->json($data);
    }
}
