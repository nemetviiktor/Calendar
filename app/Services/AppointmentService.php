<?php

namespace App\Services;

use App\Models\Appointment;
use App\Services\OpeningHoursService;
use App\Helpers\OpeningHoursUtility;

class AppointmentService
{
    private $openingHoursService;

    public function __construct(OpeningHoursService $openingHoursService)
    {
        $this->openingHoursService = $openingHoursService;
    }
    public function getAppointments()
    {
        $appointments = Appointment::all();
        $data = [];

        foreach ($appointments as $appointment) {
            $data[] = [
                'start' => $appointment->start,
                'end' => $appointment->end,
                'title' => $appointment->username
            ];
        }

        return $data;
    }
    public function checkAppointmentConflict($start, $end)
    {
        $conflictingAppointments = Appointment::where(function ($query) use ($start, $end) {
            $query->where('start', '<', $end)
                ->where('end', '>', $start);
        })->get();

        return $conflictingAppointments->isNotEmpty();
    }

    public function createAppointment($requestData)
    {
        $start = $requestData->input('start');
        $end = $requestData->input('end');

        if ($this->checkAppointmentConflict($start, $end)) {
            return ['message' => 'Appointment conflicts with existing event', 'conflict' => true];
        }

        if ($this->openingHoursService->isWithinOpeningHours($start)) {
            $appointment = new Appointment();
            $appointment->fill($requestData->only('start', 'end', 'username'));
            $appointment->save();

            return ['message' => 'Event created successfully'];
        } else {
            return ['message' => 'Not in opening hours'];
        }
    }
}
