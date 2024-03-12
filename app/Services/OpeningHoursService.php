<?php

namespace App\Services;

use App\Models\OpeningHours;
use App\Helpers\OpeningHoursUtility;

class OpeningHoursService
{
    public function getOpeningHoursData()
    {
        $openingHours = OpeningHours::all();
        $data = [];

        $openingHoursUtility = new OpeningHoursUtility();

        foreach ($openingHours as $openingHour) {
            if ($openingHour->freq !== null)
            {
                $data[] = $this->getRecurringOpeningHourData($openingHour, $openingHoursUtility);
            }
            else
            {
                $data[] = $this->getSingleOpeningHourData($openingHour, $openingHoursUtility);
            }
        }
        return $data;
    }

    private function getRecurringOpeningHourData($openingHour, $openingHoursUtility)
    {
        return [
            'display' => 'background',
            'rrule' => [
                'freq' => $openingHour->freq,
                'interval' => (int)$openingHour->interval,
                'byweekday' => $openingHour->byweekday,
                'dtstart' => $openingHoursUtility->getDtStart($openingHour->dtstart, $openingHour->time),
                'until' => $openingHour->until
            ],
            'duration' => $openingHoursUtility->getDuration($openingHour->time),
            'groupId' => 'openingHours'
        ];
    }

    private function getSingleOpeningHourData($openingHour, $openingHoursUtility)
    {
        return [
            'display' => 'background',
            'start' => $openingHoursUtility->getDtStart($openingHour->dtstart, $openingHour->time),
            'end' => $openingHoursUtility->getEnd($openingHour->dtstart, $openingHour->time),
            'groupId' => 'openingHours'
        ];
    }
}
