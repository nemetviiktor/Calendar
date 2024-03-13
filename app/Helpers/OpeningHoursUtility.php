<?php

namespace App\Helpers;

use App\Services\OpeningHoursService;


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
}
