<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentsController;

Route::resource('/', AppointmentsController::class);

Route::get('/getAppointments', [AppointmentsController::class, 'getAppointments']);
