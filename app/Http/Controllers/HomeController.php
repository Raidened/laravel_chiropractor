<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

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
    public function index(Request $request)
    {
        $selectedDoctorId = $request->input('doctor_id');

        $appointments = Appointment::all();

        if ($selectedDoctorId) {
            $doctor = User::find($selectedDoctorId);
            if ($doctor) {
                $appointments = $appointments->where('doctor_name', $doctor->name);
            }
        }


        $events = [];
        foreach ($appointments as $appointment) {
            $events[] = [
                'doctor_name' => $appointment->doctor_name,
                'status' => $appointment->status,
                'client_note' => $appointment->client_note,
                'start' => date('Y-m-d', strtotime($appointment->schedule->day)) . 'T' . date('H:i:s', strtotime($appointment->schedule->hour_start)),
                'end' => date('Y-m-d', strtotime($appointment->schedule->day)) . 'T' . date('H:i:s', strtotime($appointment->schedule->hour_end)),
                'color' => $appointment->status ? '#28a745' : '#ffc107'
            ];
        }


        $doctors = User::where('rank', 1)->get();
        return view('home', compact('events', 'doctors', 'selectedDoctorId'));
    }
}
