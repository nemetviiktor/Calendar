<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AppointmentService;

class AppointmentsController extends Controller
{
    private $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index(Request $request)
    {
        return view('appointments.index');
    }

    public function getAppointments()
    {
        $appointments = $this->appointmentService->getAppointments();
        return response()->json($appointments);
    }

    public function store(Request $request)
    {
        $response = $this->appointmentService->createAppointment($request);
        return response()->json($response);
    }
}
