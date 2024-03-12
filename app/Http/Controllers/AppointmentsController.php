<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Helpers\OpeningHoursUtility;

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

        return response()->json($data);
    }

    public function store(Request $request)
    {

        $openingHoursUtility = new OpeningHoursUtility();

        if ($openingHoursUtility->isWithinOpeningHours($request->input('start')))
        {
            $appointment = new Appointment();
            $appointment->fill($request->only('start', 'end', 'username'));
            $appointment->save();
            return response()->json(['message' => 'Event updated successfully']);
        }
        else
        {
            return response()->json(['message' => 'Not in opening hours']);
        }
    }
}
