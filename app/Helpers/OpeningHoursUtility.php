<?php

namespace App\Helpers;

use App\Services\OpeningHoursService;
use RRule\RRule;
use App\Http\Controllers\OpeningHoursController;
use Carbon\Carbon;

class OpeningHoursUtility
{
    public function getDtStart($date, $time) {
        $times = explode('-', $time);
        return $date."T".$times[0];
    }

    public function getEnd($date, $time) {
        $times = explode('-', $time);
        return $date."T".$times[1];
    }

    public function getDuration($time) {
        [$startTime, $endTime] = explode('-', $time);
        [$startHour, $startMinute] = explode(':', $startTime);
        [$endHour, $endMinute] = explode(':', $endTime);

        $totalMinutes = ($endHour * 60 + $endMinute) - ($startHour * 60 + $startMinute);

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public function isWithinOpeningHours($date) {

        $openingHoursService = new OpeningHoursService();
        $openingHoursData = $openingHoursService->getOpeningHoursData();

        $occurrences = [];
        foreach ($openingHoursData as $openingHourData) {
            if (isset($openingHourData['rrule'])) {
                $rule = new RRule([
                    'FREQ' => $openingHourData['rrule']['freq'],
                    'INTERVAL' => $openingHourData['rrule']['interval'],
                    'BYDAY' => $openingHourData['rrule']['byweekday'],
                    'DTSTART' => $openingHourData['rrule']['dtstart'],
                    'UNTIL' => '2024-12-31'
                ]);
                $occurrences = array_merge($occurrences, $rule->getOccurrences());
            } else {
                $occurrences[] = Carbon::parse($openingHourData['start']);
            }
        }

        $dateToSearch = Carbon::parse($date)->toDateString();
        foreach ($occurrences as $occurrence) {
            $formattedDate = $occurrence->format('Y-m-d');
            if ($formattedDate === $dateToSearch) {
                return true;
            }
        }
        return false;
    }
}
