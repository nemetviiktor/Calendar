<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\OpeningHoursController;

Route::resource('/', AppointmentsController::class);

Route::get('/getAppointments', [AppointmentsController::class, 'getAppointments']);

Route::get('/getOpeningHours', [OpeningHoursController::class, 'getOpeningHours']);
