<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();

        return view('appointments.index', compact('appointments'));
    }

    public function getAppointments()
    {
        $appointments = Appointment::all();

        return response()->json($appointments);
    }

    /*
    public function create()
    {
        return view('appointments.create');
    }
    */

    public function store(Request $request)
    {
        $appointment = new Appointment();
        $appointment->fill($request->only('date'));
        $appointment->save();

        return response()->json(['message' => 'Event updated successfully']);
    }

}
