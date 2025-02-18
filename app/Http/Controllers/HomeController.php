<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = Appointment::all()->map(function($appointment) {
            return [
                'title' => $appointment->type,
                'doctor_name' => $appointment->doctor_name,
                'status' => $appointment->status,
                'client_note' => $appointment->client_note,
                'start' => date('Y-m-d', strtotime($appointment->schedule->day)) . 'T' . $appointment->schedule->hour_start,
                'end' => date('Y-m-d', strtotime($appointment->schedule->day)) . 'T' . $appointment->schedule->hour_end
            ];
        })->toArray();

        return view('home', compact('events'));
    }
}
