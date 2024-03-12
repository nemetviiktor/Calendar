<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Helpers\OpeningHoursUtility;
use Carbon\Carbon;

class AppointmentsController extends Controller
{


    public function index(Request $request)
    {

        return view('appointments.index');
    }

    public function getAppointments()
    {
        $appointments = Appointment::all();
        $data = [];

        foreach($appointments as $appointment)
        {
            $data[] = [
                'start' => $appointment->start,
                'end' => $appointment->end,
                'title' => $appointment->username
            ];
        }
        //$appointment = $this->getAppointmentByStart()
        return response()->json($data);
    }

    public function checkAppointmentConflict($start, $end)
    {
        $conflictingAppointments = Appointment::where(function ($query) use ($start, $end) {
            $query->where('start', '<', $end)
                ->where('end', '>', $start);
        })->get();

        return $conflictingAppointments->isNotEmpty();
    }

    public function store(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        $conflict = $this->checkAppointmentConflict($start, $end);
        $openingHoursUtility = new OpeningHoursUtility();

        if ($conflict) {
            return response()->json(['message' => 'Appointment conflicts with existing event']);
        }

        if ($openingHoursUtility->isWithinOpeningHours($start)) {
            $appointment = new Appointment();
            $appointment->fill($request->only('start', 'end', 'username'));
            $appointment->save();

            return response()->json(['message' => 'Event created successfully']);
        } else {
            return response()->json(['message' => 'Not in opening hours']);
        }
    }
}
