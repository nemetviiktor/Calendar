<?php

namespace App\Helpers;

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

        $openingHoursController = new OpeningHoursController();
        $openingHours = $openingHoursController->getOpeningHours();
        $openingHoursData = json_decode($openingHours->getContent(), true);

        $length = count($openingHoursData)-1;

        $rules = [];
        $occurrences = [];
        for ($i = 0; $i <= $length; $i++) {
            $rules[] = new RRule([
                'FREQ' => $openingHoursData[$i]['rrule']['freq'],
                'INTERVAL' => $openingHoursData[$i]['rrule']['interval'],
                'BYDAY' => $openingHoursData[$i]['rrule']['byweekday'],
                'DTSTART' => $openingHoursData[$i]['rrule']['dtstart'],
                'UNTIL' => '2024-12-31'
            ]);
            $occurrences = array_merge($occurrences, $rules[$i]->getOccurrences());
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
