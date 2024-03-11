<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
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
        $appointment = new Appointment();
        $appointment->fill($request->only('start', 'end', 'username'));
        $appointment->save();

        return response()->json(['message' => 'Event updated successfully']);
    }
}
