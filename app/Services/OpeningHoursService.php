<?php

namespace App\Services;

use App\Models\OpeningHours;
use App\Helpers\OpeningHoursUtility;

class OpeningHoursService
{
    private $openingHoursUtility;

    public function __construct(OpeningHoursUtility $openingHoursUtility)
    {
        $this->openingHoursUtility = $openingHoursUtility;
    }

    public function getOpeningHoursData()
    {
        $openingHours = OpeningHours::all();
        $data = [];

        foreach ($openingHours as $openingHour) {
            if ($openingHour->freq !== null) {
                $data[] = $this->getRecurringOpeningHourData($openingHour);
            } else {
                $data[] = $this->getSingleOpeningHourData($openingHour);
            }
        }
        return $data;
    }

    private function getRecurringOpeningHourData($openingHour)
    {
        return [
            'display' => 'background',
            'rrule' => [
                'freq' => $openingHour->freq,
                'interval' => (int)$openingHour->interval,
                'byweekday' => $openingHour->byweekday,
                'dtstart' => $this->openingHoursUtility->getDtStart($openingHour->dtstart, $openingHour->time),
                'until' => $openingHour->until
            ],
            'duration' => $this->openingHoursUtility->getDuration($openingHour->time),
            'groupId' => 'openingHours'
        ];
    }

    private function getSingleOpeningHourData($openingHour)
    {
        return [
            'display' => 'background',
            'start' => $this->openingHoursUtility->getDtStart($openingHour->dtstart, $openingHour->time),
            'end' => $this->openingHoursUtility->getEnd($openingHour->dtstart, $openingHour->time),
            'groupId' => 'openingHours'
        ];
    }
}
