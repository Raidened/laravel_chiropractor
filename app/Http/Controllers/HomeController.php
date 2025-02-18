<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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
                'start' => $appointment->date,
                'doctor_name' => $appointment->doctor_name,
                'status' => $appointment->status,
                'client_note' => $appointment->client_note
            ];
        })->toArray();

        return view('home', compact('events'));
    }
}
